function ok() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'success',
		title: 'Data Berhasil Di Simpan.'
	})

}


function delet() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'success',
		title: 'Data Berhasil Di Hapus.'
	})
}

function update_data() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'success',
		title: 'Data berhasil di rubah.'
	})

}

function cek() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Data Harap di lengkapi'
	})

}

function sudax(war) {
	var tam =war;
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: tam
	})

}

function add_error() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Data Yang Di Simpan Sudah Ada'
	})

}

function error() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Data Belum Benar'
	})

}

function del_error() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Data Yang Di hapus Gagal'
	})

}

function updat_error() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Update Data  Gagal'
	})

}

function profile(e) {
	Swal.fire({
		title: 'Apakah data sudah benar?',
		icon: 'question',
		popup: 'swal2-show',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, cencel'
	}).then((result) => {
		if (result.value) {
			document.location.href = e;
		}
	})
}

function voting_error() {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	Toast.fire({
		icon: 'warning',
		title: 'Pilih salah satau jawaban'
	})

}
