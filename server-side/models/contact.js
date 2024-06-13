const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../config/db");

const Contact = sequelize.define(
  "Contact",
  {
    user_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      primaryKey: true,
    },
    username: {
      type: DataTypes.STRING(255),
      allowNull: false,
    },
    email: {
      type: DataTypes.STRING(255),
      allowNull: false,
    },
    nama_lengkap: {
      type: DataTypes.STRING(255),
      allowNull: false,
    },
    no_ktp: {
      type: DataTypes.STRING(20),
      allowNull: false,
    },
    no_hp: {
      type: DataTypes.STRING(20),
      allowNull: false,
    },
    jenis_kelamin: {
      type: DataTypes.ENUM("Laki-laki", "Perempuan", "Lainnya"),
      allowNull: false,
    },
    tanggal_daftar: {
      type: DataTypes.DATE,
      allowNull: true,
      defaultValue: Sequelize.NOW,
    },
    alamat_lengkap: {
      type: DataTypes.TEXT,
      allowNull: false,
    },
    kecamatan: {
      type: DataTypes.STRING(100),
      allowNull: false,
    },
    kabupaten_kota: {
      type: DataTypes.STRING(100),
      allowNull: false,
    },
    provinsi: {
      type: DataTypes.STRING(100),
      allowNull: false,
    },
    kode_pos: {
      type: DataTypes.STRING(10),
      allowNull: false,
    },
    status_akun: {
      type: DataTypes.ENUM("Aktif", "Tidak Aktif", "Diblokir", "Tertunda"),
      allowNull: false,
    },
  },
  {
    timestamps: false,
    tableName: "contacts",
  }
);

module.exports = Contact;
