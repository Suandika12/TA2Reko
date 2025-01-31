import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:recomend_toba/data_katalog/data_katalog_screen.dart';

class JudulEkatalog extends StatelessWidget {
  const JudulEkatalog({super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(left: 15, right: 15),
      child: Row(crossAxisAlignment: CrossAxisAlignment.center, children: [
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              "E-Katalog",
              style: GoogleFonts.openSans(
                textStyle: TextStyle(
                  color: Colors.grey[800],
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
            Text(
              "Informasi Katalog Pelatihan",
              style: GoogleFonts.openSans(
                textStyle: TextStyle(
                  color: Colors.grey[800],
                  fontSize: 12,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
          ],
        ),
        const Spacer(),
        InkWell(
          onTap: () {
            Navigator.of(context).pushNamed(DataKatalogScreen.routeName);
          },
          child: Row(children: [
            Text(
              "Semua Katalog",
              style: GoogleFonts.openSans(
                textStyle: TextStyle(
                  color: Colors.grey[800],
                  fontSize: 12,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
            const Icon(Icons.arrow_right),
          ]),
        )
      ]),
    );
  }
}
