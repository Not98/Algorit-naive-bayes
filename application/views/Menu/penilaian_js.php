<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
		<b>Version</b> 1
	</div>
	<strong>Copyright &copy; <?= date('Y') ?> <a href="">Programer Mahal</a>.</strong> All rights
	reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/jquery/jquery-3.3.1.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/DataTables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/plugin') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/plugin') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/plugin') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets') ?>/message.js"></script>
<script type="text/javascript">
	function format(d) {
		var id = d.id;

		return '<table id="detail"cellpadding="5" data="' + id + '" cellspacing="0" border="0" style="padding-left:50px;">' +


		'</table><button type="button" data="' + id + '" name="edit_detail" class="btn btn-primary float-right"> Edit</button>';


	}

	// function tammp(d) {
	// 	var id = d.id;

	// 	$.ajax({
	// 		type: "get",
	// 		contentType: "application/json; charset=utf-8",
	// 		dataType: "JSON",
	// 		url: "<?= base_url('menu/jawabn') ?>",
	// 		data: {
	// 			id: id
	// 		},
	// 		success: function(response) {
	// 			console.log(d);
	// 			var tam='';
	// 			tam += '	<thead>' +
	// 				'<th>Jawan Yang akan di tampilkan</th>	</thead><tbody>';
	// 			for (let index = 0; index < response.length; index++) {
	// 				tam += '<tr role="row" class="odd">' +
	// 					'<td  class="sorting_1">' + response[index].jawaban + '</td>';

	// 			}

	// 			tam += '</tbody>';

	// 			$('#detail').html(tam);


	// 		}
	// 	});
	// 	return false;
	// }


	$(document).ready(function() {

		var nilai = $("#tb_nilai").DataTable({
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
			[0, 'asc']
			],
			"ajax": {
				"url": "<?php echo base_url('Tabel/kategori') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
			[5, 10, 50],
			[5, 10, 50]
			], // Combobox Limit
			"columns": [{
				"title": "No",
				"data": null
			},
			{
				"title": "Penilaian",
				"data": "kategori"
			},

			{
				"title": "Aksi",
				"render": function(data, type, row) {
						// Tampilkan kolom aksi
						var i;
						var html = '';
						html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" crfsN="<?= $q ?>"data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit" crfsnU="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></span></a>';
						return html
					}
				}
				]
			});

		var layanan = $("#tbl_layanan").DataTable({
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
			[0, 'asc']
			],
			"ajax": {
				"url": "<?php echo base_url('Tabel/tbl_layanan') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
			[5, 10, 50],
			[5, 10, 50]
			], // Combobox Limit
			"columns": [{
				"title": "No",
				"data": null
			},
			{
				"title": "Layanan",
				"data": "layanan"
			},
			{
				"title": "Aksi",
				"render": function(data, type, row) {
						// Tampilkan kolom aksi
						var i;
						var html = '';

						html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_layanan" crfsLH="<?= $q ?>" data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_layanan" lcrfs="<?= $q ?>" data="' + row.id + '"><span class="fas fa-edit"></i></span></a>';
						return html
					}
				}
				]
			});
		var kuesioner = $("#tbl_kuesioner").DataTable({
			"responsive": true,

			"processing": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
			[0, 'asc']
			],
			"ajax": {
				"url": "<?php echo base_url('Tabel/tbl_kuesioner') ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
			[5, 10, 50],
			[5, 10, 50]
			], // Combobox Limit

			"columns": [

			{
				"title": "No",
				"data": null
			},
			{
				"className": 'details-control',
				"orderable": false,
				"data": null,
				"defaultContent": ''
			},
			{
				"title": "Layanan",
				"data": "layanan"
			},
			{
				"title": "kuesioner",
				"data": "pertanyaan"
			},
			{
				"title": "Aksi",
				"render": function(data, type, row) {
						// Tampilkan kolom aksi
						var i;
						var html = '';

						html = '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus_kues"crfskh="<?= $q ?>" data="' + row.id + '"><span class="fa fa-trash"></span></a>  <a href="javascript:;" class="btn btn-info btn-xs item_edit_kues" crfske="<?= $q ?>"data="' + row.id + '"><span class="fas fa-edit"></i></span></a>';



						return html
					}
				}
				]
			});

		//pilihan kuisioner

		function pilih() {
			var key = $('#La').attr('key')
			$.ajax({
				type: "post",
				url: "<?= base_url('menu/kuisioner') ?>",
				data: {
					key: key
				},
				dataType: "json",
				success: function(data) {
					var html;
					html += '<option>--Pilih Layanan --</option>';
					for (let index = 0; index < data.length; index++) {
						html += '<option value="' + data[index].id + '" >' + data[index].layanan + '</option>';

					}
					$('#La').html(html);
				}
			})
		}

		function jwabT() {
			$.ajax({
				type: "GET",
				url: "<?= base_url('menu/get_jwab_a') ?>",
				dataType: "JSON",
				success: function(response) {
					var tam;
					for (let index = 0; index < response.length; index++) {

						tam += '<td><input type="checkbox" class="get_value"data="' + response[index].kategori + '" name="jwb[]"value="' + response[index].id + '"> ' +
						'<label>' + response[index].kategori + '</label></td>';
					}
					$('.jwb').html(tam);
				}
			});
		}
		jwabT();


		//membuat nomer urut
		layanan.on('draw.dt', function() {
			var PageInfo = $('#tbl_layanan').DataTable().page.info();
			layanan.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});
		nilai.on('draw.dt', function() {
			var PageInfo = $('#tb_nilai').DataTable().page.info();
			nilai.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});
		kuesioner.on('draw.dt', function() {
			var PageInfo = $('#tbl_kuesioner').DataTable().page.info();
			kuesioner.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});

		function reload_layanan() {
			layanan.ajax.reload(null, true); //reload datatable ajax
		}

		function reload_kat() {
			nilai.ajax.reload(null, true); //reload datatable ajax
		}

		function reload_kuesioner() {
			kuesioner.ajax.reload(null, true); //reload datatable ajax
		}

		//TBL NIlai
		//Pengambilan
		$('#tb_nilai').on('click', '.item_edit', function() {
			var id = $(this).attr('data');
			var crfs = $(this).attr('crfsnU');
			$.ajax({
				type: "POST",
				url: "<?= base_url('menu/getidkat') ?>",
				data: {
					id: id,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					var html;
					$('#modalEdit').modal('show');
					html = '<div class="form-group row">' +
					'<label for="" class="col-sm-3 col-form-label">Nama Jawaban</label>' +
					'<div class="col-sm">' +
					'<input type="text"data="' + response[0].id + '"class="form-control"Value="' + response[0].kategori + '"name="kat">' +
					' </div>' +
					'</div><br>' +

					'</div>';
					var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button type="button" class="btn btn-primary" crfsne="<?= $q ?>" data="" id="btn_update_K">Updat</button>';
					$('#btn').html(btn);
					$('#edit').html(html);
				}
			})
		});
		$('#tb_nilai').on('click', '.item_hapus', function() {
			var id = $(this).attr('data');
			var crfs = $(this).attr('crfsN');
			$.ajax({
				type: "POST",
				url: "<?= base_url('menu/getidkat') ?>",
				data: {
					id: id,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					var html = '';
					$('#ModalHapus').modal('show');
					$('[name="id"]').val(response[0].id);
					html = '<p>Apakah Anda yakin mau memhapus data niali  ' + response[0].kategori + '?</p>  ';
					var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button type="button" class="btn btn-primary" crfsNH="' + "<?= $q ?> " + '" id="btn_hapus_n">Hapus</button>';
					$('#btn_h').html(btb);
					$('#nama').html(html);

				}
			})

		});
		//aksi
		$('#ModalHapus').on('click', '#btn_hapus_n', function() {
			var id = $("[name='id']").val();
			var crfs = $('#btn_hapus_n').attr('crfsNH');
			$.ajax({
				type: "Post",
				url: "<?= base_url('menu/deletka') ?>",
				data: {
					id: id,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					if (response.message == "delet") {
						$('#ModalHapus').modal('hide');
						delet();
						reload_kat();
					} else if (response.message == "del_error") {
						$('#ModalHapus').modal('hide');
						del_error();
					}
				}
			})
			return false;
		});

		$('[name="btn_simapn_P"]').on('click', function() {
			var Kategori = $('[name="Kategori"]').val();
			var NilaiK = $('[name="NilaiK"]').val();

			if (Kategori === '') {
				cek();
			} else if (NilaiK === '') {
				cek();
			} else {
				$.ajax({
					type: "POST",
					url: "<?= base_url('menu/simpanKategori') ?>",
					data: {
						Kategori: Kategori,

					},
					dataType: "JSON",
					success: function(data) {
						if (data.message == "ok") {
							$('[name="NilaiK"]').val("");
							$('[name="Kategori"]').val("");
							ok();
							reload_kat();
							jwabT();
						} else if (data.message == "gagal") {
							add_error();
						} else if (data.message == "error") {
							cek();
						}
					}
				})
			}

			return false;
		})
		$('#modalEdit').on('click', '#btn_update_K', function() {
			var kat = $("[name='kat']").val();
			var nil = $("[name='nil']").val();
			var id = $("[name='kat']").attr('data');
			var crfs = $(this).attr('crfsne');
			$.ajax({
				type: "Post",
				url: "<?= base_url('menu/updatekat') ?>",
				data: {
					id: id,

					kat: kat,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					console.log(response.message)
					if (response.message == "update") {
						$('#modalEdit').modal('hide');
						reload_kat();
						update_data();
					} else if (response.message == "update_error") {
						$('#modalEdit').modal('hide');
						updat_error();
					}


				}
			})
			return false;
		});
		//TBL Layanan
		$('#tbl_layanan').on('click', '.item_edit_layanan', function() {
			var id = $(this).attr('data');
			var lcrfs = $(this).attr('lcrfs');
			$.ajax({
				type: "POST",
				url: "<?= base_url('menu/getidlayanan') ?>",
				data: {
					id: id,
					lcrfs: lcrfs
				},
				dataType: "json",
				success: function(response) {
					var html;
					$('#modalEdit').modal('show');
					html = '<div class="form-group row">' +
					'<label for="" class="col-sm-3 col-form-label">Nama Layanan</label>' +
					'<div class="col-sm">' +
					'<input type="text"data="' + response[0].id + '"class="form-control<?= form_error('nilai') ? 'is-invalid' : ''; ?>"Value="' + response[0].layanan + '"name="layanan">' +
					' </div>' +
					'</div><br>' +
					'</div>';
					var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button type="button" class="btn btn-primary" crfslu="' + "<?= $q ?>" + '"data="" id="btn_updateM">Updat</button>';
					$('#btn').html(btn);
					$('#edit').html(html);
				}
			})

		});
		$('#tbl_layanan').on('click', '.item_hapus_layanan', function() {
			var id = $(this).attr('data');
			var lcrfs = $(this).attr('crfsLH');
			$.ajax({
				type: "POST",
				url: "<?= base_url('menu/getidlayanan') ?>",
				data: {
					id: id,
					lcrfs: lcrfs
				},
				dataType: "json",
				success: function(response) {
					var html = '';
					$('#ModalHapus').modal('show');
					$('[name="id"]').val(response[0].id);

					html = '<p>Apakah Anda yakin mau memhapus data " ' + response[0].layanan + '" ?</p>  ';
					var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button type="button" class="btn btn-primary" crfslh="' + "<?= $q ?>" + '"id="btn_hapus_M">Hapus</button>';
					$('#btn_h').html(btb);
					$('#nama').html(html);
				}
			})
		});

		//aksi
		$('#ModalHapus').on('click', '#btn_hapus_M', function() {
			var id = $("[name='id']").val();
			var lcrfslh = $('#btn_hapus_M').attr('crfslh');
			$.ajax({
				type: "Post",
				url: "<?= base_url('menu/deletlayanan') ?>",
				data: {
					id: id,
					lcrfslh: lcrfslh
				},
				dataType: "json",
				success: function(response) {
					if (response.message == "delet") {
						$('#ModalHapus').modal('hide');
						$('[name="id"]').val("");
						delet();
						reload_layanan();
					} else if (response.message == "del_error") {
						$('#ModalHapus').modal('hide');
						del_error();
					}
				}
			})
			return false;
		});
		$('#modalEdit').on('click', '#btn_updateM', function() {
			var layanan = $("[name='layanan']").val();
			var id = $("[name='layanan']").attr('data');
			var crfslu = $('#btn_updateM').attr('crfslu');
			$.ajax({
				type: "Post",
				url: "<?= base_url('menu/updatelayanan') ?>",
				data: {
					id: id,
					layanan: layanan,
					crfslu: crfslu
				},
				dataType: "json",
				success: function(response) {
					if (response.message == "delet") {
						$('#modalEdit').modal('hide');
						reload_layanan();
						update_data();
					} else if (response.message == "del_error") {
						$('#modalEdit').modal('hide');
						updat_error();
					}
				}
			})
			return false;
		});
		$('[name="btn_simapn_l"]').on('click', function() {
			var Layanann = $('[name="Layanann"]').val();
			if (Layanann === '') {
				cek();
			} else {

				$.ajax({
					type: "POST",
					url: "<?= base_url('menu/simpanlayanan') ?>",
					data: {
						Layanann: Layanann
					},
					dataType: "JSON",

					success: function(data) {
						if (data.message == "ok") {
							$('[name="Layanann"]').val("");
							ok();
							pilih();
							reload_layanan();
						} else if (data.message == "sudah_ada") {
							add_error();
						} else if (data.message == "error") {
							cek();
						}
					}
				})
			}

			return false;
		})

		///kuesioner


		pilih();
		$('#tbl_kuesioner').on('click', '.item_hapus_kues', function() {
			var id = $(this).attr('data');
			var crfs = $(this).attr('crfskh');

			$.ajax({
				type: "POST",
				url: "<?= base_url('menu/getidku') ?>",
				data: {
					id: id,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					var html = '';
					$('#ModalHapus').modal('show');
					$('[name="id"]').val(response[0].id);
					html = '<p>Apakah Anda yakin mau memhapus data kuesioner  ' + response[0].pertanyaan + '?</p>  ';
					var btb = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button type="button" class="btn btn-primary"data="' + response[0].id + '" crfskd="' + "<?= $q ?>" + '" id="btn_hapus_kue">Hapus</button>';
					$('#btn_h').html(btb);
					$('#nama').html(html);

				}
			})

		});
		$('#tbl_kuesioner tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = kuesioner.row(tr);
			var nw = row.data()
			var id = nw.id;
			var tampill;
			if (row.child.isShown()) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
				document.getElementById("tampile").remove();
				tampill = "";
			} else {
				tr.addClass('shown');
				tampill = $.ajax({
					type: "get",

					url: "<?= base_url('menu/jawabn') ?>",
					// url: "<?= base_url('menu/get_jwab_a') ?>",

					data: {
						id: id
					},
					contentType: "application/json; charset=utf-8",
					dataType: "JSON",
					success: function(response) {
						console.log(response[1].id);
						var ha;
						var tam;
						tam += '<thead id="tampile">' +
						'<th>Jawan Yang akan di tampilkan</th>	</thead><tbody id="det">';


						for (let index = 0; index < response.length; index++) {
							var idd = [response[index].id];
							// cekbok(idd,row);
							tam += '<tr><td>' +
								// '<input type="checkbox" class="get_value"data="'+response[index].kategori+'" name="detaile[]"value="'+response[index].id+'"> '+
								'<label>' + response[index].jawaban + '</label>';
							// '</td><td id="jawaban">'+response[index].nilai +'</td></tr>';
						}

						// tam+='<tr><td><a href="javascript:;" class="btn btn-danger btn-xs item_edit_j"crfskh="<?= $q ?>" data="' + id + '"><span class="fa fa-trash"></span></a></td> <tr></tbody></table>';
						row.child(tam).show();

					}
				});
			}

			return true;
			///Penampilan detail

			// row.child( tammp(row.data()) ).show();



		});

		$('#tbl_kuesioner').on('click', '.item_edit_kues', function() {
			var crfs = $(this).attr('crfske');
			var id = $(this).attr('data');
			var cek;
			var tam, tam1, tamp2;
			var cekb = $('.get_value').each(function() {
				$(this).val();
			})
			$.ajax({
				type: "GET",
				url: "<?= base_url('menu/get_edit_j') ?>",
				data: {
					id: id,
					crfs: crfs
				},
				dataType: "json",
				success: function(response) {
					$('#modalEdit').modal('show');
					tam += '<div class="form-group row">' +
					'<label for="" class="col-sm-3 col-form-label">Layanan</label>' +
					'<div class="col-sm">' +
					'<select class="form-control"id="La_u" key="f64bcbe9a0d6aba323de32598558d87f15df084c396b401d8024ac1ad170714d5fc6963842ca3c7b5c3b93a006f826d5ea77b435ffe0f2e3068d270852a12ee9AvAN6GXxwneWMVMTe4E+I4s4Bzd6Yxs9DqARhfDmYDXs5371JQJQ+AL9y/U84QHl" name="La_u" >' +
					'<option name="ops" value="' + response.idL[0] + '">' + response.layanan[0] + '</option>';
					for (var i = 0; i < response.layananf.length; i++) {
						if (response.layananf[i].layanan == response.layanan[0]) {
							tam += "";
						} else {
							tam += '<option name="ops" value="' + response.layananf[i].id + '">' + response.layananf[i].layanan + '</option>';

						}
					}

					tam += '</select>' +
					'</div>' +
					'</div>' +
					'<div class="form-group row">' +
					'<label for="" class="col-sm-3 col-form-label">jawaban yang di tampilkan</label>' +
					'<div class="col-sm jwb">';

					for (var i = 0; i < response.jawaban.length; i++) {
						// console.log(response.jawaban[i].id);
						if (response.idJ[i] === "undefined") {
							tam += "";
						} else {

							if (response.jawaban[i].id == response.idJ[i]) {
								tam += '<td><input type="checkbox" class="get_value_u"data="' + response.jawaban[i].id + '" name="jwb_u[]"value="' + response.jawaban[i].id + '"checked> ' +
								'<label>' + response.jawaban[i].kategori + '</label></td>';
							} else {
								tam += '<td><input type="checkbox" class="get_value_u"data="' + response.jawaban[i].id + '" name="jwb_u[]"value="' + response.jawaban[i].id + '"> ' +
								'<label>' + response.jawaban[i].kategori + '</label></td>'
							}
						}

					}
					tam += '</div>' +
					'</div>' +
					'<div class="form-group row">' +
					'<label for="" class="col-sm-3 col-form-label">kuesioner</label>' +
					'<div class="col-sm">' +
					'<textarea class="form-control" rows="3" name="pertanyaan_u"placeholder="Pertanyaan">' + response.pertanyaan[0] + '</textarea>' +
					'</div>' +
					'</div>';


					var btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
					'<button  type="button" id="btn_edit_kueS"class="btn btn-primary float-right"data="' + response.pid[0] + '"> Update</button>';
					if (tam === "undefined") {

					} else {

						$('#btn').html(btn);
						$('#edit').html(tam);
					}

					// $('#simpan').remove();
					// $('.soal').html(tam);

					// tam += '<option>'+response.layanan+'</option>';



				}
			});
			return false;
		});
		$('#modalEdit').on('click', '#btn_edit_kueS', function() {
			var id = $('#btn_edit_kueS').attr('data');
			var key = $('#La_u').attr('key');
			var l = $("[name='La_u']").val();
			var p = $("[name='pertanyaan_u']").val();
			var d = $('[name="jwb_u[]"]').each(function() {
				$(this).map(function() {
					return this.elements ? $.makeArray(this.elements) : this;
				})
				$(this).filter(function() {
					return this.name && !this.disabled && (this.checked);
				})
				.map(function(i, elem) {
					var val = $(this).val();
					return val == null ?
					null :
					$.isArray(val) ?
					$.map(val, function(val, i) {
						return {
							name: elem.name,
							value: val
						};
					}) : {
						name: elem.name,
						value: ($(this).checkboxesAsBools && this.type === 'checkbox') ?
						(this.checked ? true : false) : val
					};
				}).get();

			});
			if (l === "--Pilih Layanan --") {
				cek();
			} else if (p === "" || d.serializeArray({
				checkboxesAsBools: true
			}).length < 2) {
				cek();
			} else {
				$.ajax({
					type: "post",
					url: "<?= base_url('menu/updatjawaban') ?>",
					data: {
						jawab: d.serializeArray({
							checkboxesAsBools: true
						}),
						p: p,
						l: l,
						key: key,
						id: id
					},
					dataType: "json",
					success: function(respons) {
						if (respons.message == "ok") {
							$('#modalEdit').modal('hide');

							ok();
							reload_kuesioner();
						} else if (responsok.message == "sudah_ada") {
							add_error();
						} else if (respons.message == "error") {
							cek();
						}
					}
				});

			}


		})
		//aksi

		$('#ModalHapus').on('click', '#btn_hapus_kue', function() {
			var crfs = $(this).attr('crfskd');
			var id = $(this).attr('data');
			$.ajax({
				type: "get",
				url: "<?= base_url('menu/deljwb_k') ?>",
				data: {
					crfs: crfs,
					id: id
				},
				dataType: "JSON",
				success: function(response) {
					if (response.message == "error") {
						error();
					} else if (response.message == "del_ok") {
						$('#ModalHapus').modal('hide');
						delet();
						reload_kuesioner();
					} else if (response.message == "del_error") {
						del_error();

					}

				}
			});

		})
		$('[name="btn_simapn_ku"]').on('click', function() {
			var key = $('#La').attr('key');
			var l = $("[name='La']").val();
			var p = $("[name='pertanyaan']").val();
			var ks=$("[name='kats']").val();
			var d = $('.get_value').each(function() {
				$(this).map(function() {
					return this.elements ? $.makeArray(this.elements) : this;
				})
				$(this).filter(function() {
					return this.name && !this.disabled && (this.checked);
				})
				.map(function(i, elem) {
					var val = $(this).val();
					return val == null ?
					null :
					$.isArray(val) ?
					$.map(val, function(val, i) {
						return {
							name: elem.name,
							value: val
						};
					}) : {
						name: elem.name,
						value: ($(this).checkboxesAsBools && this.type === 'checkbox') ?
						(this.checked ? true : false) : val
					};
				}).get();

			});
			if (l === "--Pilih Layanan --") {
				cek();
			}else if(ks==="Pilih kategori Mhs"){
				cek();
			} else if (p === "" || d.serializeArray({
				checkboxesAsBools: true
			}).length < 2) {
				cek();
			} else {
				var j = [d.serializeArray({
					checkboxesAsBools: true
				})];


				$.ajax({
					type: "post",
					url: "<?= base_url('menu/addjawaban') ?>",
					data: {
						jawab: d.serializeArray({
							checkboxesAsBools: true
						}),
						p: p,
						l: l,
						key: key,
						ks:ks
					},
					dataType: "json",
					success: function(respons) {
						// console.log(respons.error);

						if (respons.message == "ok") {
							$("[name='La']").val("--Pilih Layanan --");
							$("[name='kat']").val("Pilih kategori Mhs");
							$("[name='pertanyaan']").val('');

							ok();
							reload_kuesioner();
						} else if (respons.message == "data_ada") {
							add_error();
						} else if (respons.error) {
							add_error();
						}
					}
				});

			}

			return false;
		});


	});
</script>

</body>

</html>