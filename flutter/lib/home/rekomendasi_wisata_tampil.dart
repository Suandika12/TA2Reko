import 'package:flutter/material.dart';
import 'package:recomend_toba/config/color.dart';
import 'package:recomend_toba/data_wisata/data/data_wisata_apidata.dart';
import 'package:recomend_toba/config/config_global.dart';

import '../data_wisata/data_wisata_detail_screen.dart';

const bool showImageCard = true;

class RekomendasiWisataTampil extends StatefulWidget {
  final DataWisataApiData data;
  final Function(DataWisataApiData value) onTapEdit;
  final Function(DataWisataApiData value) onTapHapus;

  const RekomendasiWisataTampil({
    super.key,
    required this.data,
    required this.onTapEdit,
    required this.onTapHapus,
  });

  @override
  State<RekomendasiWisataTampil> createState() =>
      _RekomendasiWisataTampilState();
}

class _RekomendasiWisataTampilState extends State<RekomendasiWisataTampil> {
  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.of(context).pushNamed(
          DataWisataDetailScreen.routeName,
          arguments: DataWisataDetailArguments(
            data: widget.data,
            judul: "Detail Wisata",
          ),
        );
      },
      child: Card(
        child: Padding(
          padding: const EdgeInsets.all(6),
          child: Stack(
            children: [
              Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  if (showImageCard)
                    SizedBox(
                      height: 120,
                      width: double.infinity,
                      child: Image.network(
                        "${ConfigGlobal.baseUrl}/admin/upload/${widget.data.foto}",
                        fit: BoxFit.fill,
                      ),
                    ),
                  const SizedBox(height: 6),
                  Text(
                    "${widget.data.namaWisata}",
                    overflow: TextOverflow.fade,
                    maxLines: 2,
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  // Text(
                  //   "${widget.data.deskripsi}",
                  //   style: const TextStyle(fontSize: 16),
                  // ),
                  // Text(
                  //   "Koordinat : ${widget.data.koordinat}",
                  //   style: const TextStyle(fontSize: 16),
                  // ),
                ],
              ),
              Positioned(
                top: 0,
                left: 0,
                child: Container(
                  decoration: BoxDecoration(
                    color: Style.buttonBackgroundColor,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  margin: const EdgeInsets.all(9.0),
                  padding: const EdgeInsets.all(6),
                  child: Text(
                    "${widget.data.score?.toStringAsFixed(3)}",
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
