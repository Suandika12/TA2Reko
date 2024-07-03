import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:recomend_toba/config/config_global.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:recomend_toba/data/data_filter.dart';
import 'package:recomend_toba/data_jam_operasional/bloc/data_jam_operasional_bloc.dart';
import 'package:recomend_toba/data_jam_operasional/bloc/data_jam_operasional_hapus_bloc.dart';
import 'package:recomend_toba/data_jam_operasional/bloc/data_jam_operasional_simpan_bloc.dart';
import 'package:recomend_toba/data_jam_operasional/bloc/data_jam_operasional_ubah_bloc.dart';
import 'package:recomend_toba/data_jam_operasional/data/data_jam_operasional_apidata.dart';
import 'package:recomend_toba/data_jam_operasional/data_jam_operasional_tampil_select.dart';
import 'package:recomend_toba/widgets/loading_widget.dart';
import 'package:recomend_toba/widgets/tombol.dart';
import 'package:recomend_toba/config/config_session_manager.dart';

class DataJamOperasionalScreen extends StatefulWidget {
  static const routeName = '/data_jam_operasional';

  const DataJamOperasionalScreen({super.key});

  @override
  State<DataJamOperasionalScreen> createState() =>
      _DataJamOperasionalScreenState();
}

class _DataJamOperasionalScreenState extends State<DataJamOperasionalScreen> {
  DataFilter filter = const DataFilter();

  List<Map<String, dynamic>> listPencarian = [
    {"key": "id_jam_operasional", "value": "Id Jam Operasional"},
    {"key": "jam_operasional", "value": "Jam Operasional"},
    {"key": "nilai", "value": "Nilai"},
  ];

  String valuePencarian = "id_jam_operasional";

  var pencarianController = TextEditingController();
  var waktuController = TextEditingController();

  @override
  void initState() {
    super.initState();
    getSession();
  }

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    fetchData(); // Ensure data is fetched when dependencies change
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Data Jam Operasional'),
      ),
      body: MultiBlocListener(
        listeners: [
          BlocListener<DataJamOperasionalHapusBloc,
              DataJamOperasionalHapusState>(
            listener: (context, state) {
              if (state is DataJamOperasionalHapusLoadSuccess) {
                fetchData(); // Fetch data when an item is deleted successfully
              }
            },
          ),
          BlocListener<DataJamOperasionalUbahBloc, DataJamOperasionalUbahState>(
            listener: (context, state) {
              if (state is DataJamOperasionalUbahLoadSuccess) {
                fetchData(); // Fetch data when an item is updated successfully
              }
            },
          ),
          BlocListener<DataJamOperasionalSimpanBloc,
              DataJamOperasionalSimpanState>(
            listener: (context, state) {
              if (state is DataJamOperasionalSimpanLoadSuccess) {
                fetchData(); // Fetch data when an item is saved successfully
              }
            },
          ),
        ],
        child: Stack(
          children: [
            ListView(
              children: [
                Image.asset(
                  "assets/background_data.png",
                  fit: BoxFit.fitWidth,
                ),
              ],
            ),
            Positioned(
              right: 0,
              top: 10,
              child: Image.asset(
                "assets/avatar.png",
                height: 100,
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(left: 10, right: 10, bottom: 10),
              child: Padding(
                padding: const EdgeInsets.all(5),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    SingleChildScrollView(
                      scrollDirection: Axis.horizontal,
                      child: Row(
                        children: [
                          const SizedBox(width: 3),
                          TombolRefreshWidget(
                            onPress: () {
                              fetchData();
                            },
                          ),
                          const SizedBox(width: 10),
                        ],
                      ),
                    ),
                    if (pencarianController.text.isNotEmpty ||
                        waktuController.text.isNotEmpty)
                      Card(
                        child: Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 6),
                          child: Row(
                            children: [
                              Expanded(
                                child: resultPencarian(valuePencarian),
                              ),
                              TextButton(
                                onPressed: () {
                                  filter = filter.copyWith(
                                    berdasarkan: "",
                                    isi: "",
                                  );
                                  fetchData();
                                  setState(() {
                                    pencarianController.text = "";
                                    waktuController.text = "";
                                  });
                                },
                                child: const Text("Reset"),
                              )
                            ],
                          ),
                        ),
                      ),
                    const SizedBox(height: 10),
                    Expanded(
                      child: Builder(
                        builder: (context) {
                          final stateData =
                              context.watch<DataJamOperasionalBloc>().state;
                          final stateHapus = context
                              .watch<DataJamOperasionalHapusBloc>()
                              .state;
                          if (stateData is DataJamOperasionalLoading ||
                              stateHapus is DataJamOperasionalHapusLoading) {
                            return const LoadingWidget();
                          }
                          if (stateData is DataJamOperasionalLoadSuccess) {
                            List<DataJamOperasionalApiData> data =
                                stateData.data.result;
                            if (data.isEmpty) {
                              return NoInternetWidget(
                                pesan: "Maaf, data masih kosong!",
                              );
                            }
                            return ListView.builder(
                              itemCount: data.length,
                              itemBuilder: (context, index) {
                                return DataJamOperasionalTampilSelect(
                                  data: data[index],
                                );
                              },
                            );
                          }
                          if (stateData is DataJamOperasionalLoadFailure) {
                            return NoInternetWidget(pesan: stateData.pesan);
                          }
                          return NoInternetWidget();
                        },
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Future<void> _showPencarianDialog() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        return StatefulBuilder(
          builder: (context, setState) => AlertDialog(
            title: const Text('Pencarian'),
            content: SingleChildScrollView(
              child: ListBody(
                children: [
                  DropdownButtonFormField<String>(
                    isExpanded: true,
                    value: valuePencarian,
                    decoration: const InputDecoration(
                      isDense: true,
                      fillColor: Colors.white,
                      border: OutlineInputBorder(),
                      focusedBorder: OutlineInputBorder(
                        borderRadius: BorderRadius.all(
                          Radius.circular(5.0),
                        ),
                        borderSide: BorderSide(color: Colors.blue),
                      ),
                      filled: true,
                    ),
                    onChanged: (String? value) {
                      setState(() {
                        valuePencarian = value!;
                      });
                    },
                    items: listPencarian.map((Map<String, dynamic> item) {
                      return DropdownMenuItem<String>(
                        value: item["key"],
                        child: Text(
                          item["value"],
                          style: const TextStyle(color: Colors.black),
                        ),
                      );
                    }).toList(),
                  ),
                  const SizedBox(height: 15),
                  Builder(
                    builder: (context) {
                      if (isPencarianTanggal(valuePencarian)) {
                        return TextFormField(
                          controller: waktuController,
                          readOnly: true,
                          onTap: () {
                            showDatePicker(
                              context: context,
                              initialDate: DateTime.now(),
                              firstDate: DateTime(1990, 1),
                              lastDate: DateTime(2025, 12),
                            ).then((pickedDate) {
                              if (pickedDate != null) {
                                waktuController.text =
                                    DateFormat('y-M-d').format(pickedDate);
                              }
                            });
                          },
                          decoration: InputDecoration(
                            prefixIcon: const Icon(Icons.book),
                            labelText: 'Waktu ',
                            labelStyle: const TextStyle(color: Colors.black),
                            fillColor: Colors.white,
                            filled: true,
                            enabledBorder: OutlineInputBorder(
                              borderSide: const BorderSide(
                                  color: Colors.black, width: 1.0),
                              borderRadius: BorderRadius.circular(10.0),
                            ),
                            focusedBorder: OutlineInputBorder(
                              borderSide: const BorderSide(
                                  color: Colors.black, width: 2.0),
                              borderRadius: BorderRadius.circular(10.0),
                            ),
                            contentPadding: const EdgeInsets.symmetric(
                              vertical: 15.0,
                              horizontal: 10.0,
                            ),
                            errorStyle: const TextStyle(
                              color: Colors.red,
                            ),
                            errorBorder: OutlineInputBorder(
                              borderSide: const BorderSide(
                                color: Colors.red,
                              ),
                              borderRadius: BorderRadius.circular(10.0),
                            ),
                            focusedErrorBorder: OutlineInputBorder(
                              borderSide: const BorderSide(
                                  color: Colors.red, width: 2.0),
                              borderRadius: BorderRadius.circular(10.0),
                            ),
                          ),
                        );
                      }
                      return TextFormField(
                        controller: pencarianController,
                        decoration: const InputDecoration(
                          isDense: true,
                          hintText: 'Cari disini',
                          border: OutlineInputBorder(),
                        ),
                      );
                    },
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      TextButton(
                        child: const Text('Cari'),
                        onPressed: () {
                          if (isPencarianTanggal(valuePencarian)) {
                            filter = filter.copyWith(
                              berdasarkan: valuePencarian,
                              isi: waktuController.text,
                            );
                          } else {
                            filter = filter.copyWith(
                              berdasarkan: valuePencarian,
                              isi: pencarianController.text,
                            );
                          }

                          fetchData();
                          Navigator.of(context).pop();
                        },
                      ),
                      TextButton(
                        child: const Text('Batal'),
                        onPressed: () {
                          Navigator.of(context).pop();
                        },
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
        );
      },
    );
  }

  void getSession() async {
    var session = await ConfigSessionManager.getInstance().getData();
    if (session == null) {
      return;
    }
    filter = DataFilter(idPeserta: "${session.id}");
    fetchData(); // Fetch data when session is initialized
  }

  @override
  void dispose() {
    pencarianController.dispose();
    waktuController.dispose();
    super.dispose();
  }

  void fetchData() async {
    BlocProvider.of<DataJamOperasionalBloc>(context).add(
      FetchDataJamOperasional(filter),
    );
  }

  void prosesHapus(value) {
    BlocProvider.of<DataJamOperasionalHapusBloc>(
      context,
    ).add(
      FetchDataJamOperasionalHapus(
        data: value,
      ),
    );
  }

  bool isPencarianTanggal(String valuePencarian) {
    return valuePencarian == "waktu";
  }

  Widget resultPencarian(String valuePencarian) {
    var textPencarian =
        listPencarian.firstWhere((e) => e['key'] == valuePencarian)['value'];
    if (isPencarianTanggal(valuePencarian)) {
      return Text(
          "Pencarian $textPencarian \"${ConfigGlobal.formatTanggal(waktuController.text)}\"");
    }
    return Text("Pencarian $textPencarian \"${pencarianController.text}\"");
  }
}
