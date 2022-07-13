<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Chuyển đổi</title>
</head>

<body>
    <div class="container">
        @php
        $url = app('request')->route()->uri();
        @endphp
        <ul class="nav justify-content-center nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ $url=='/'?'active':'' }}" aria-current="page" href="{{ url('/') }}">XMLs to EXCEL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $url=='zip'?'active':'' }}" href="{{ url('/zip') }}">ZIPs to EXCEL</a>
            </li>
        </ul>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Chọn các file Nén(.ZIP)</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" type="file" id="myfile" accept=".zip" onchange="onMyfileChange(this)" multiple>
                        </div>
                        <div class="col-md-2"><button class="btn btn-warning" onClick="window.location.reload();"><i class="bi-arrow-clockwise bi-spin"></i> Làm mới</button></div>
                    </div>
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action"><i style="font-weight:bold;">File không chuyển đổi được: <span id="countError">0</span></i></a>
                    <div id="listFileError"></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <table id="excelTable" class="table table-bordered table-hover display table-sm" style="width: 170%;">
        <thead>
            <tr>
                <th style="width:5px; font-style: italic; background-color:#adc1eb;">STT</th>
                <th style="font-style: italic; background-color:#adc1eb;">Mẫu số</th>
                <th style="font-style: italic; background-color:#adc1eb;">Ký hiệu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Số HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tính chất HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">Ngày HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">MST</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Nhà cung cấp</th>
                <th style="width:18%; font-style: italic; background-color:#adc1eb;">Địa chỉ</th>
                <th style="font-style: italic; background-color:#adc1eb;">MST bên mua</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Tên bên mua</th>
                <th style="width:18%; font-style: italic; background-color:#adc1eb;">Địa chỉ bên mua</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tính chất</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Tên hàng hoá, dịch vụ</th>
                <th style="font-style: italic; background-color:#adc1eb;">HTTT</th>
                <th style="font-style: italic; background-color:#adc1eb;">ĐVT</th>
                <th style="font-style: italic; background-color:#adc1eb;">Số lượng</th>
                <th style="font-style: italic; background-color:#adc1eb;">Đơn giá</th>
                <th style="background-color:#80d4ff; font-style: italic;">Tổng cộng</th>
                <th style="background-color:#ffbf80; font-style: italic;">Thành tiền</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tổng tiền chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thành tiền sau chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Đơn giá sau chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thuế suất</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tiền thuế</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thành tiền có thuế GTGT</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th style="width:5px; font-style: italic; background-color:#adc1eb;">STT</th>
                <th style="font-style: italic; background-color:#adc1eb;">Mẫu số</th>
                <th style="font-style: italic; background-color:#adc1eb;">Ký hiệu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Số HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tính chất HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">Ngày HĐ</th>
                <th style="font-style: italic; background-color:#adc1eb;">MST</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Nhà cung cấp</th>
                <th style="width:18%; font-style: italic; background-color:#adc1eb;">Địa chỉ</th>
                <th style="font-style: italic; background-color:#adc1eb;">MST bên mua</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Tên bên mua</th>
                <th style="width:18%; font-style: italic; background-color:#adc1eb;">Địa chỉ bên mua</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tính chất</th>
                <th style="width:10%; font-style: italic; background-color:#adc1eb;">Tên hàng hoá, dịch vụ</th>
                <th style="font-style: italic; background-color:#adc1eb;">HTTT</th>
                <th style="font-style: italic; background-color:#adc1eb;">ĐVT</th>
                <th style="font-style: italic; background-color:#adc1eb;">Số lượng</th>
                <th style="font-style: italic; background-color:#adc1eb;">Đơn giá</th>
                <th style="background-color:#80d4ff; font-style: italic;">Tổng cộng</th>
                <th style="background-color:#ffbf80; font-style: italic;">Thành tiền</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tổng tiền chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thành tiền sau chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Đơn giá sau chiết khấu</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thuế suất</th>
                <th style="font-style: italic; background-color:#adc1eb;">Tiền thuế</th>
                <th style="font-style: italic; background-color:#adc1eb;">Thành tiền có thuế GTGT</th>
            </tr>
        </tfoot>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#excelTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'pageLength'
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
            });
        })
    </script>
    <script src="https://unpkg.com/jszip@3.7.1/dist/jszip.js" type="text/javascript"></script>
    <script type="text/javascript">
        function onMyfileChange(fileInput) {
            $('#excelTable').DataTable().destroy();
            $('tbody').html('')
            const page = parseInt(fileInput.files.length);
            let stt = 0;
            let error = 0;
            for (let i = 0; i < page; i++) {
                var filename = fileInput.files[i].name;
                // var filesize = fileInput.files[0].size;
                const reader = new FileReader();
                reader.readAsArrayBuffer(fileInput.files[i]);
                reader.onload = function(ev) {
                    JSZip.loadAsync(ev.target.result).then(function(zip) {
                        const nameFile = Object.keys(zip.files);
                        nameFile.map((item, index) => {
                            if (item.includes('.xml')) {
                                zip.file(item).async("text")
                                    .then(function success(txt) {
                                        console.log(item);
                                        console.log($.parseXML(txt));
                                        const xmlDoc = $.parseXML(txt);
                                        if ($(xmlDoc).find("HDon>MCCQT").text()) {
                                            const mshdon = $(xmlDoc).find("TTChung>KHMSHDon").text();
                                            const khhdon = $(xmlDoc).find("TTChung>KHHDon").text();
                                            const shdon = $(xmlDoc).find("TTChung>SHDon").text();
                                            const ngayhdon = $(xmlDoc).find("TTChung>NLap").text();
                                            var tchdon = $(xmlDoc).find("TTHDLQuan>TCHDon").text();
                                            const htttoan = $(xmlDoc).find("TTChung>HTTToan").text();
                                            const ncc = $(xmlDoc).find("NBan>Ten").text();
                                            const mst = $(xmlDoc).find("NBan>MST").text();
                                            const diachi = $(xmlDoc).find("NBan>DChi").text();
                                            const tenmua = $(xmlDoc).find("NMua>Ten").text();
                                            const mstmua = $(xmlDoc).find("NMua>MST").text();
                                            const dcmua = $(xmlDoc).find("NMua>DChi").text();

                                            const dateInvoice = (ngayhdon.replace('/', '-')).split('-');
                                            const getDate = dateInvoice[2] + '/' + dateInvoice[1] + '/' + dateInvoice[0];
                                            if (tchdon === "1") tchdon = "Thay thế";
                                            else if (tchdon === "2") tchdon = "Điều chỉnh";
                                            $('#excelTable').DataTable().destroy();
                                            $(xmlDoc).find("HHDVu").map((item, index) => {
                                                var tienCK = (parseFloat($(index).find("HHDVu>STCKhau").text())).toString();
                                                if (isNaN(tienCK)) tienCK = 0;
                                                var vat = $(index).find("HHDVu>TSuat").text();
                                                var money = (parseFloat($(index).find("HHDVu>DGia").text())).toString();
                                                var count = (parseFloat($(index).find("HHDVu>SLuong").text())).toString();
                                                var total = (parseFloat($(index).find("HHDVu>ThTien").text())).toString();
                                                var tienthue = parseInt((vat).replace('%', ''));
                                                var tienSauCK = parseFloat(count * money - tienCK);
                                                var tienVat = parseFloat(tienSauCK * parseFloat(tienthue / 100));
                                                $('tbody').append(
                                                    "<tr> <td>" + parseInt(stt + 1) + "</td>\
                                                    <td>" + mshdon + "</td>\
                                                    <td>" + khhdon + "</td>\
                                                    <td>" + shdon + "</td>\
                                                    <td>" + tchdon + "</td>\
                                                    <td>" + getDate + "</td>\
                                                    <td>" + mst + "</td>\
                                                    <td>" + ncc + "</td>\
                                                    <td>" + diachi + "</td>\
                                                    <td>" + mstmua + "</td>\
                                                    <td>" + tenmua + "</td>\
                                                    <td>" + dcmua + "</td>\
                                                    <td>" + $(index).find("HHDVu>TChat").text() + "</td>\
                                                    <td>" + $(index).find("HHDVu>THHDVu").text() + "</td>\
                                                    <td>" + htttoan + "</td>\
                                                    <td>" + $(index).find("HHDVu>DVTinh").text() + "</td>\
                                                    <td>" + count + "</td>\
                                                    <td>" + parseFloat(money).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td style='background-color:#b3e6ff;'>" + parseFloat(total).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td style='background-color:#ffd9b3;'>" + parseFloat(count * money).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td>" + (parseFloat($(index).find("HHDVu>STCKhau").text())).toString() + "</td>\
                                                    <td>" + parseFloat(tienSauCK).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td>" + parseFloat(tienSauCK / count).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td>" + vat + "</td>\
                                                    <td>" + parseFloat(tienVat).toFixed(2).toLocaleString("en-US") + "</td>\
                                                    <td>" + parseFloat(tienSauCK + tienVat).toFixed(2).toLocaleString("en-US") + "</td> </tr>")
                                                stt = parseInt(stt + 1);
                                            });
                                            $('#excelTable').DataTable({
                                                dom: 'Bfrtip',
                                                buttons: [
                                                    'copyHtml5',
                                                    'excelHtml5',
                                                    'csvHtml5',
                                                    'pdfHtml5',
                                                    'pageLength'
                                                ],
                                                lengthMenu: [
                                                    [10, 25, 50, -1],
                                                    ['10 rows', '25 rows', '50 rows', 'Show all']
                                                ],
                                            });
                                        } else {
                                            error += 1;
                                            $('#listFileError').append(
                                                '<a href="#" class="list-group-item list-group-item-action">' + fileInput.files[i].name + '</a>'
                                            );
                                            $('#countError').text(error);
                                        }
                                    }, function error(e) {
                                        console.error(e);
                                    });
                            }
                        });
                    }).catch(function(err) {
                        console.error("Failed to open", filename, " as ZIP file");
                    })
                };
                reader.onerror = function(err) {
                    console.error("Failed to read file", err);
                }
            }
        }
    </script>
</body>

</html>