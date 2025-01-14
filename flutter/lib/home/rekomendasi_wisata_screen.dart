import 'package:flutter/material.dart';
import 'package:flutter_layout_grid/flutter_layout_grid.dart';
import 'package:intl/intl.dart';
import 'package:logger/logger.dart';
import 'package:recomend_toba/config/config_global.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:recomend_toba/data_harga_tiket/data/data_harga_tiket_apidata.dart';
import 'package:recomend_toba/data_harga_tiket/data_harga_tiket_screen.dart';
import 'package:recomend_toba/data_hari_operasional/data/data_hari_operasional_apidata.dart';
import 'package:recomend_toba/data_hari_operasional/data_hari_operasional_screen.dart';
import 'package:recomend_toba/data_jam_operasional/data/data_jam_operasional_apidata.dart';
import 'package:recomend_toba/data_jam_operasional/data_jam_operasional_screen.dart';
import 'package:recomend_toba/data_jenis_wisata/data/data_jenis_wisata_apidata.dart';
import 'package:recomend_toba/data_jenis_wisata/data_jenis_wisata_screen.dart';
import 'package:recomend_toba/data_rating/data/data_rating_apidata.dart';
import 'package:recomend_toba/data_rating/data_rating_screen.dart';
import 'package:recomend_toba/data_wilayah/data/data_wilayah_apidata.dart';
import 'package:recomend_toba/data_wilayah/data_wilayah_screen.dart';
import 'package:recomend_toba/data_wisata/bloc/data_wisata_bloc.dart';
import 'package:recomend_toba/data_wisata/bloc/data_wisata_hapus_bloc.dart';
import 'package:recomend_toba/data_wisata/bloc/data_wisata_simpan_bloc.dart';
import 'package:recomend_toba/data_wisata/bloc/data_wisata_ubah_bloc.dart';
import 'package:recomend_toba/data_wisata/data/data_wisata.dart';
import 'package:recomend_toba/data_wisata/data/data_wisata_apidata.dart';
// import 'package:recomend_toba/data_wisata/data_wisata_tampil.dart';
import 'package:recomend_toba/data_wisata/data_wisata_ubah.dart';
import 'package:recomend_toba/home/filter_pencarian.dart';
import 'package:recomend_toba/home/rekomendasi_wisata_tampil.dart';
import 'package:recomend_toba/widgets/loading_widget.dart';
import 'package:recomend_toba/config/config_session_manager.dart';

class RekomendasiWisataScreen extends StatefulWidget {
  static const routeName = '/rekomendasi_wisata_screen';

  const RekomendasiWisataScreen({super.key});

  @override
  State<RekomendasiWisataScreen> createState() =>
      _RekomendasiWisataScreenState();
}

class _RekomendasiWisataScreenState extends State<RekomendasiWisataScreen> {
  final filter = FilterPencarian();

  List<Map<String, dynamic>> listPencarian = [
    // {"key": "id_wisata", "value": "Id Wisata"},
    {"key": "nama_wisata", "value": "Nama Wisata"},
    {"key": "foto", "value": "Foto"},
    {"key": "deskripsi", "value": "Deskripsi"},
    {"key": "koordinat", "value": "Koordinat"},
    {"key": "id_jenis_wisata", "value": "Id Jenis Wisata"},
    {"key": "id_wilayah", "value": "Id Wilayah"},
    {"key": "id_rating", "value": "Id Rating"},
    {"key": "id_harga_tiket", "value": "Id Harga Tiket"},
    {"key": "id_hari_operasional", "value": "Id Hari Operasional"},
    {"key": "id_jam_operasional", "value": "Id Jam Operasional"},
  ];

  String valuePencarian = "nama_wisata";

  var pencarianController = TextEditingController();
  var waktuController = TextEditingController();

  var bobotJenisWisataController = TextEditingController();
  var jenisWisataController = TextEditingController();
  var bobotWilayahController = TextEditingController();
  var wilayahController = TextEditingController();
  var bobotRatingController = TextEditingController();
  var ratingController = TextEditingController();
  var bobotHargaTiketController = TextEditingController();
  var hargaTiketController = TextEditingController();
  var bobotHariOperasionalController = TextEditingController();
  var hariOperasionalController = TextEditingController();
  var bobotJamOperasionalController = TextEditingController();
  var jamOperasionalController = TextEditingController();

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  final logger = Logger();

  @override
  void initState() {
    jenisWisataController.addListener(() {
      // filter.bobotJenisWisata = bobotJenisWisataController.text;
    });

    bobotWilayahController.addListener(() {
      // filter.bobotWilayah = bobotWilayahController.text;
    });

    bobotRatingController.addListener(() {
      // filter.bobotRating = bobotRatingController.text;
    });

    bobotHargaTiketController.addListener(() {
      // filter.bobotHargaTiket = bobotHargaTiketController.text;
    });

    bobotHariOperasionalController.addListener(() {
      // filter.bobotHariOperasional = bobotHariOperasionalController.text;
    });

    bobotJamOperasionalController.addListener(() {
      // filter.bobotJamOperasional = bobotJamOperasionalController.text;
    });

    super.initState();
    getSession();
    fetchData();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Rekomendasi Wisata',
        ),
      ),
      body: MultiBlocListener(
        listeners: [
          BlocListener<DataWisataHapusBloc, DataWisataHapusState>(
            listener: (context, state) {
              if (state is DataWisataHapusLoadSuccess) {
                fetchData();
              }
            },
          ),
          BlocListener<DataWisataUbahBloc, DataWisataUbahState>(
            listener: (context, state) {
              if (state is DataWisataUbahLoadSuccess) {
                fetchData();
              }
            },
          ),
          BlocListener<DataWisataSimpanBloc, DataWisataSimpanState>(
            listener: (context, state) {
              if (state is DataWisataSimpanLoadSuccess) {
                fetchData();
              }
            },
          ),
        ],
        child: Stack(
          children: [
            Form(
              key: _formKey,
              child: Padding(
                padding: const EdgeInsets.all(3),
                child: Padding(
                  padding: const EdgeInsets.all(0.1),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      const SizedBox(height: 1),
                      LayoutGrid(
                        columnSizes: [0.05.fr, 0.05.fr],
                        rowSizes: const [
                          auto,
                          auto,
                          auto,
                          auto,
                          auto,
                          auto,
                        ],
                        rowGap: 1,
                        columnGap: 1,
                        children: [
                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                border: OutlineInputBorder(),
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                                labelText: 'Jenis Wisata',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 4.0,
                                    horizontal:
                                        12.0), // Sesuaikan padding vertikal
                              ),
                              controller: jenisWisataController,
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(DataJenisWisataScreen.routeName);
                                if (data is DataJenisWisataApiData) {
                                  filter.idJenisWisata = data.idJenisWisata;
                                  logger.d(
                                      'debug: filter = ${filter.toString()}');

                                  jenisWisataController.text =
                                      "${data.jenisWisata}";
                                  bobotJenisWisataController.text =
                                      "${data.nilai}";
                                }
                              },
                            ),
                          ),

                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                border: OutlineInputBorder(),
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                                labelText: 'Wilayah',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 8.0, horizontal: 12.0),
                              ),
                              controller: wilayahController,
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(DataWilayahScreen.routeName);
                                if (data is DataWilayahApiData) {
                                  filter.idWilayah = data.idWilayah;
                                  logger.d(
                                      'debug: filter = ${filter.toString()}');
                                  wilayahController.text = "${data.wilayah}";
                                  bobotWilayahController.text = "${data.nilai}";
                                }
                              },
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                                border: OutlineInputBorder(),
                                labelText: 'Rating',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 8.0, horizontal: 12.0),
                              ),
                              controller: ratingController,
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(DataRatingScreen.routeName);
                                if (data is DataRatingApiData) {
                                  filter.idRating = data.idRating;
                                  logger.d(
                                      'debug: filter = ${filter.toString()}');
                                  ratingController.text = "${data.rating}";
                                  bobotRatingController.text = "${data.nilai}";
                                }
                              },
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                                border: OutlineInputBorder(),
                                labelText: 'Harga Tiket',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 8.0, horizontal: 12.0),
                              ),
                              controller: hargaTiketController,
                            
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(DataHargaTiketScreen.routeName);
                                if (data is DataHargaTiketApiData) {
                                  filter.idHargaTiket = data.idHargaTiket;
                                  logger.d('debug: filter = $filter');
                                  hargaTiketController.text =
                                      "${data.hargaTiket}";
                                  bobotHargaTiketController.text =
                                      "${data.nilai}";
                                }
                              },
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                border: OutlineInputBorder(),
                                labelText: 'Hari Operasional',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 8.0, horizontal: 12.0),
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                              ),
                              controller: hariOperasionalController,
                            
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(
                                        DataHariOperasionalScreen.routeName);
                                if (data is DataHariOperasionalApiData) {
                                  filter.idHariOperasional =
                                      data.idHariOperasional;
                                  logger.d('debug: filter = $filter');
                                  hariOperasionalController.text =
                                      "${data.hariOperasional}";
                                  bobotHariOperasionalController.text =
                                      "${data.nilai}";
                                }
                              },
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(
                              top: 2.0,
                            ),
                            child: TextFormField(
                              readOnly: true,
                              decoration: const InputDecoration(
                                suffixIcon: Icon(Icons.keyboard_arrow_down),
                                border: OutlineInputBorder(),
                                labelText: 'Jam Operasional',
                                contentPadding: EdgeInsets.symmetric(
                                    vertical: 8.0, horizontal: 12.0),
                              ),
                              controller: jamOperasionalController,
                             
                              onTap: () async {
                                var data = await Navigator.of(context)
                                    .pushNamed(
                                        DataJamOperasionalScreen.routeName);
                                if (data is DataJamOperasionalApiData) {
                                  filter.idJamOperasional =
                                      data.idJamOperasional;
                                  logger.d('debug: filter = $filter');
                                  jamOperasionalController.text =
                                      "${data.jamOperasional}";
                                  bobotJamOperasionalController.text =
                                      "${data.nilai}";
                                }
                              },
                            ),
                          ),
                        ],
                      ),
                      SizedBox(
                        width: double.infinity,
                        child: ElevatedButton(
                          onPressed: () {
                            fetchData();
                          },
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: const [
                              Icon(Icons.recommend_rounded),
                              SizedBox(width: 6),
                              Text("Cari Rekomendasi Moora"),
                            ],
                          ),
                        ),
                      ),
                      const SizedBox(height: 8),
                      Expanded(
                        child: Builder(builder: (context) {
                          final stateData =
                              context.watch<DataWisataBloc>().state;
                          final stateHapus =
                              context.watch<DataWisataHapusBloc>().state;
                          if (stateData is DataWisataLoading ||
                              stateHapus is DataWisataHapusLoading) {
                            return const LoadingWidget();
                          }
                          if (stateData is DataWisataLoadSuccess) {
                            List<DataWisataApiData> data =
                                sort(stateData.data.result, true);
                            if (data.isEmpty) {
                              return NoInternetWidget(
                                pesan: "Maaf, data masih kosong!",
                              );
                            }
                            return ListView.builder(
                              /* physics: const NeverScrollableScrollPhysics(), */
                              /* shrinkWrap: true, */
                              itemCount: data.length,
                              itemBuilder: ((context, index) {
                                return RekomendasiWisataTampil(
                                  data: data[index],
                                  onTapHapus: (value) async {
                                    /* BlocProvider.of<DataWisataHapusBloc>(
                                      context,
                                    ).add(
                                      FetchDataWisataHapus(
                                        data: value,
                                      ),
                                    ); */

                                    showDialog(
                                      context: context,
                                      builder: (BuildContext context) {
                                        return AlertDialog(
                                          title: const Text(
                                              'Konfirmasi Penghapusan'),
                                          content: const Text(
                                              'Apakah Anda yakin ingin menghapus data ini?'),
                                          actions: <Widget>[
                                            TextButton(
                                              onPressed: () {
                                                Navigator.of(context).pop();
                                              },
                                              child: const Text('Batal'),
                                            ),
                                            TextButton(
                                              onPressed: () {
                                                prosesHapus(value);
                                                Navigator.of(context)
                                                    .pop(); // Tutup dialog
                                              },
                                              child: const Text(
                                                'Hapus',
                                                style: TextStyle(
                                                    color: Colors.red),
                                              ),
                                            ),
                                          ],
                                        );
                                      },
                                    );
                                  },
                                  onTapEdit: (value) async {
                                    var data = DataWisata(
                                      idWisata: value.idWisata,
                                      namaWisata: value.namaWisata,
                                      foto: value.foto,
                                      deskripsi: value.deskripsi,
                                      koordinat: value.koordinat,
                                      idJenisWisata: value.idJenisWisata,
                                      idWilayah: value.idWilayah,
                                      idRating: value.idRating,
                                      idHargaTiket: value.idHargaTiket,
                                      idHariOperasional:
                                          value.idHariOperasional,
                                      idJamOperasional: value.idJamOperasional,
                                      jenisWisata: value.jenisWisata,
                                      wilayah: value.wilayah,
                                      rating: value.rating,
                                      hargaTiket: value.hargaTiket,
                                      hariOperasional: value.hariOperasional,
                                      jamOperasional: value.jamOperasional,
                                    );
                                    await Navigator.of(context).pushNamed(
                                      DataWisataUbahScreen.routeName,
                                      arguments: DataWisataUbahArguments(
                                        data: data,
                                        judul: "Edit Data Wisata",
                                      ),
                                    );
                                    fetchData();
                                  },
                                );
                              }),
                            );
                          }
                          if (stateData is DataWisataLoadFailure) {
                            return NoInternetWidget(pesan: stateData.pesan);
                          }
                          return NoInternetWidget();
                        }),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  void getSession() async {
    var session = await ConfigSessionManager.getInstance().getData();
    if (session == null) {
      return;
    }
  }

  @override
  void dispose() {
    pencarianController.dispose();

    jenisWisataController.dispose();
    bobotWilayahController.dispose();
    wilayahController.dispose();
    bobotRatingController.dispose();
    ratingController.dispose();
    bobotHargaTiketController.dispose();
    hargaTiketController.dispose();
    bobotHariOperasionalController.dispose();
    hariOperasionalController.dispose();
    bobotJamOperasionalController.dispose();
    jamOperasionalController.dispose();
    super.dispose();
  }

  void fetchData() async {
    BlocProvider.of<DataWisataBloc>(context).add(
      FetchRekomendasiWisata(filter),
    );
  }

  void prosesHapus(value) {
    BlocProvider.of<DataWisataHapusBloc>(
      context,
    ).add(
      FetchDataWisataHapus(
        data: value,
      ),
    );
  }

  bool isPencarianTanggal(String valuePencarian) {
    return valuePencarian == "waktu";
  }

  resultPencarian(valuePencarian) {
    var textPencarian =
        listPencarian.firstWhere((e) => e['key'] == valuePencarian)['value'];
    if (isPencarianTanggal(valuePencarian)) {
      return Container(
        child: Text(
            "Pencarian $textPencarian \"${ConfigGlobal.formatTanggal(waktuController.text)}\""),
      );
    }
    return Container(
      child: Text("Pencarian $textPencarian \"${pencarianController.text}\""),
    );
  }

  List<DataWisataApiData> sort(List<DataWisataApiData> result, bool desc) {
    result.sort((a, b) {
      if (desc) {
        var bscore = b.score ?? 0;
        var ascore = a.score ?? 0;
        return bscore.compareTo(ascore);
      } else {
        var bscore = b.score ?? 0;
        var ascore = a.score ?? 0;
        return ascore.compareTo(bscore);
      }
    });
    return result;
  }
}
