# SIDUMASO LILIS PROJECT

koie lis carane ngopy neng project ben ora bola bali donload

- buka terminal sekarepan ng ndi
- git clone http://github.com/RiqqiAmru/sidumaso-lilis
- composer update
- (database raussah asle smn wes duwe)
- php spark serve

* enum jenis pengaduan
  infrastruktur
  sengketa lahan
  keamanan dan ketertiban
  lingkungan
  pengelolaan dana desa
  Lainnya

  intine biso tambah,
  biso edit nek pengaduane drg di proses,
  biso dihapus nek pengaduane drg diproses,
  biso nambah tanggapan nek pengaduane ws diproses,
  biso mencet selesai nek pengaduane ws diproses

status aduan
menunggu , proses , selesai

TABEL ADUAN = id, jenis_aduan, status_aduan(privat/publik), rincian, id_pengadu, id_admin, ket

0- menunggu
1- proses
2- selesai

TABEL FOTO_ADUAN =id, id_aduan, foto

tabel tanggapan = id, jenis_tanggapan, rincian_admin, rincian_pengadu, ket

0 menunggu pengirim
1 menunggu admin
2 selesai

TABEL FOTO_TANGGAPAN = id, id_tanggapan, foto, ket(admin/pengirim)

- proses -> siap kami sedang usut kepada pihak terkait
- kurang gambar -> tolong berikan gambar HD -> gambar wajib, rinciann tidak wajib
- kurang rincian -> berikan rincian lagi -> gambar tidak wajib, rincian wajib
- selesai -> rincian, gambar tidak wajib, kasus selesai
