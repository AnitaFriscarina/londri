<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Website Laundry 2020</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/dist/') ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/dist/') ?>assets/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/dist/') ?>assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/dist/') ?>assets/demo/datatables-demo.js"></script>
<!-- Bootstrap core JavaScript-->



<!-- Core plugin JavaScript-->


<script type="text/javascript">
    $(document).ready(function() {

        function dataPaket() {

            $.ajax({
                type: 'POST',
                url: '<?= base_url('Transaksi/dataPaket') ?>',
                dataType: 'json',
                success: function(data) {

                    var baris = '<select class="custom-select selek" id="selek" name="paket[]"> ';
                    baris += '<option disabled selected>Pilih Paket</option>';
                    for (var i = 0; i < data.length; i++) {
                        baris += '<option value="' + data[i].id + '">' + data[i].nama_paket + ' </option>';
                    }
                    baris += '</select>';
                    baris += '<?= form_error('paket', '<small class="text-danger pl-3">', '</small>'); ?>';

                    $('#paket').html(baris);

                    $('#selek').change(function() {
                        var n = $(this).val();
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('Transaksi/hargaPaket') ?>',
                            data: {
                                'id': n
                            },
                            dataType: 'json',
                            success: function(hasil) {
                                var hargax = hasil[0].harga;

                                $('#qty').on('keyup', function() {
                                    var qty = $(this).val();
                                    var zz = qty * hargax;
                                    var number_string = zz.toString(),
                                        sisa = number_string.length % 3,
                                        rupiah = number_string.substr(0, sisa),
                                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                                    if (ribuan) {
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }
                                    $('#subtotal').val(zz);
                                });
                            }
                        });
                    });
                    $('#tombol').click(function tambahBaris() {
                        var table = document.getElementById('dataTable');
                        var rowCount = table.rows.length; //untuk menghitung baris ke berapanya

                        var line = '<select class="custom-select selek" id="selek' + rowCount + '" name="paket[]"> ';
                        line += '<option disabled selected>Pilih Paket</option>';
                        for (var i = 0; i < data.length; i++) {
                            line += '<option value="' + data[i].id + '">' + data[i].nama_paket + ' </option>';
                        }
                        line += '</select>';
                        line += '<?= form_error('paket', '<small class="text-danger pl-3">', '</small>'); ?>';



                        html = '<tr>' +
                            '<td>' + rowCount + '</td>' +
                            '<td>' + line + '</td>' +

                            '<td>' +
                            '<input type="number" step=".01" class="form-control inputsm" id="qty' + rowCount + '" name="qty[]" value="">' +
                            '<?= form_error('qty[]', '<small class="text-danger pl-3">', '</small>'); ?>' +
                            '</td>' +

                            '<td>' +
                            '<input class="form-control inputsm" name="subtotal[]" id="subtotal' + rowCount + '" readonly value=""> ' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" class="form-control" id="keterangan" name="keterangan[]">' +
                            ' <?= form_error('keterangan[]', '<small class="text-danger pl-3">', '</small>'); ?>'
                        '< /td>' +

                        '</tr>';
                        $('#dataTable tbody').append(html);

                        $('#selek' + rowCount).change(function() {
                            var nil = $(this).val();
                            $.ajax({
                                type: 'POST',
                                url: '<?= base_url('Transaksi/hargaPaket') ?>',
                                data: {
                                    'id': nil
                                },
                                dataType: 'json',
                                success: function(result) {
                                    var hargay = result[0].harga;
                                    $('#qty' + rowCount).on('keyup', function() {
                                        var qty = $(this).val();
                                        var h = qty * hargay;
                                        var number_string = h.toString(),
                                            sisa = number_string.length % 3,
                                            rupiah = number_string.substr(0, sisa),
                                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                                        if (ribuan) {
                                            separator = sisa ? '.' : '';
                                            rupiah += separator + ribuan.join('.');
                                        }
                                        $('#subtotal' + rowCount).val(h);
                                    });
                                }
                            });
                        });
                    });

                }
            });



        }
        dataPaket();

        $('#deleteBaris').click(function() {
            var table = document.getElementById('dataTable');
            var rowCount = table.rows.length;
            if (rowCount != 2) { //jika jumlah baris tidak sama dengan 2
                rowCount -= 1; //maka kurangi jumlah barisnya
                table.deleteRow(rowCount); //lalu hapus barisnya
            }
        });

    });



    $('.badge-primary').on('click', function() {
        var id = $(this).data('id');

        var tothar = $('#totalharga' + id).val()
        var subA = tothar.substr(3);
        var total = subA.split('.').join('');
        total = parseFloat(total);
        var isipajak = 0;
        var isidiskon = 0;
        var isibt = 0;
        $('#pajak' + id).on('input', function() {
            isipajak = $(this).val();
            isipajak /= 100;
            isipajak *= total;
            $('#takhir' + id).val(total + isipajak);
            $('#diskon' + id).on('input', function() {
                isidiskon = $(this).val();
                isidiskon /= 100;
                isidiskon *= total;
                $('#takhir' + id).val((total + isipajak) - isidiskon)

            });
            $('#biayatambahan' + id).on('input', function() {
                isibt = $(this).val();
                var a = parseFloat(isibt);
                $('#takhir' + id).val(total + isipajak - isidiskon + a);
            });


        });

    });
</script>
</body>

</html>