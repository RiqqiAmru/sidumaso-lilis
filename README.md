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
2- kurang data
3 selesai
4 invalid

TABEL FOTO_ADUAN =id, id_aduan, foto

tabel tanggapan = id, jenis_tanggapan, rincian_admin, rincian_pengadu, ket

TABEL FOTO_TANGGAPAN = id, id_tanggapan, foto, ket(admin/pengirim)

error

-

# SIDUMASO LILIS PROJECT

-blum ada fitur :

1. lupa password ,
2. back up data ,
3. filtering laporan (nek difilter metu tanggapane tapi nek ora dipilih periode/tanpa filter tapi klik tombol filter, tanggapane rak kepanggil) kurang per jenis pengaduan juga
4. filtering desc di pengaduan proses ,
5. modal untuk foto tanggapan✅
6. harusnya tombol komentar jika status proses saja ,
7. ubah password,✅
8. edit pengaduan, [validasi gambar susah]
9. file bukti pengaduan diganti opsional
   -ganti view pengumuman masyarakat✅
   -keterangan di laporan tgl brp (ketika cetak laporan ada keterangan berdasarkan filter opo)
   -ganti nama field database ✅
   -tidak ada fitur nambah jenis pengaduan
   - kepala dusun tampilan nya apa
