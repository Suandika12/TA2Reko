// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'data_admin_apidata.dart';

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

DataAdminApiData _$DataAdminApiDataFromJson(Map<String, dynamic> json) =>
    DataAdminApiData(
      idAdmin: json['id_admin'] as String? ?? '',
      namaLengkap: json['nama_lengkap'] as String? ?? '',
      username: json['username'] as String? ?? '',
      password: json['password'] as String? ?? '',
    );

Map<String, dynamic> _$DataAdminApiDataToJson(DataAdminApiData instance) =>
    <String, dynamic>{
      'id_admin': instance.idAdmin,
      'nama_lengkap': instance.namaLengkap,
      'username': instance.username,
      'password': instance.password,
    };
