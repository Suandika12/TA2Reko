import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter/cupertino.dart';
import 'package:recomend_toba/config/config_global.dart';
import 'package:recomend_toba/data/data_filter.dart';
import 'package:recomend_toba/enum/data/enum_api.dart';
import 'package:recomend_toba/utils/awesome_dio_interceptor.dart';

class EnumApiService {
  Dio get dio => _dio();
  Dio _dio() {
    final options = BaseOptions(
      baseUrl: '${ConfigGlobal.baseUrl}',
      connectTimeout: 5000,
      receiveTimeout: 3000,
      contentType: "application/json;charset=utf-8",
    );

    var dio = Dio(options);

    dio.interceptors.add(AwesomeDioInterceptor(
      logRequestTimeout: false,
      logRequestHeaders: false,
      logResponseHeaders: false,

      // Optional, defaults to the 'log' function in the 'dart:developer' package.
      logger: debugPrint,
    ));

    return dio;
  }

  Future<EnumApi> getData(String tabel, String field) async {
    try {
      Response response = await dio.get(
        "/admin/app/page/data_enum/enum.php",
        queryParameters: {
          "tabel": tabel,
          "field": field,
        },
      );
      if (response.data is String) {
        return EnumApi.fromJson(jsonDecode(response.data));
      }
      return EnumApi.fromJson(response.data);
    } catch (error, stacktrace) {
      throw Exception("Exception occured: $error stackTrace: $stacktrace");
    }
  }
}
