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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Chọn file XML</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
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
    <table id="excelTable" class="table table-bordered table-hover" style="width: 150%;">
        <thead>
            <tr>
                <th style="width:5px;">STT</th>
                <th>Mẫu số</th>
                <th>Ký hiệu</th>
                <th>Ngày HĐ</th>
                <th style="width:15%">Nhà cung cấp</th>
                <th style="width:20%">Địa chỉ</th>
                <th>Tính chất</th>
                <th>Tên hàng hoá, dịch vụ</th>
                <th>ĐVT</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Tổng tiền chiết khấu</th>
                <th>Thành tiền sau chiết khấu</th>
                <th>Thuế suất</th>
                <th>Tiền thuế</th>
                <th>Thành tiền có thuế GTGT</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>STT</th>
                <th>Mẫu số</th>
                <th>Ký hiệu</th>
                <th>Ngày HĐ</th>
                <th>Nhà cung cấp</th>
                <th>Địa chỉ</th>
                <th>Tính chất</th>
                <th>Tên hàng hoá, dịch vụ</th>
                <th>ĐVT</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Tổng tiền chiết khấu</th>
                <th>Thành tiền sau chiết khấu</th>
                <th>Thuế suất</th>
                <th>Tiền thuế</th>
                <th>Thành tiền có thuế GTGT</th>
            </tr>
        </tfoot>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#formFileMultiple").change(function(event) {
                let listHHDVu = [];
                const page = parseInt(event.target.files.length);
                let stt = 0;
                let error = 0;
                for (let i = 0; i < page; i++) {
                    console.log(event.target.files[i].name + " Size:" + event.target.files[i].size);
                    const file = event.target.files[i];
                    const reader = new FileReader();
                    reader.readAsText(file);
                    reader.onloadend = function() {
                        // data
                        listHHDVu = [];
                        if (event.target.files[i].type == "text/xml") {
                            var xmlDoc = $.parseXML(reader.result);
                            if ($(xmlDoc).find("HDon>MCCQT").text()) {
                                var mshdon = $(xmlDoc).find("TTChung>KHMSHDon").text();
                                var khhdon = $(xmlDoc).find("TTChung>KHHDon").text();
                                var shdon = $(xmlDoc).find("TTChung>SHDon").text();
                                var ngayhdon = $(xmlDoc).find("TTChung>NLap").text();
                                var mst = $(xmlDoc).find("NBan>MST").text();
                                var ncc = $(xmlDoc).find("NBan>Ten").text();
                                var diachi = $(xmlDoc).find("NBan>DChi").text();
                                $(xmlDoc).find("HHDVu").map((item, index) => {
                                    listHHDVu.push({
                                        no: parseInt(stt + 1),
                                        number: mshdon,
                                        symbol: khhdon,
                                        date: ngayhdon,
                                        codeTax: mst,
                                        supplier: ncc,
                                        address: diachi,
                                        type: $(index).find("HHDVu>TChat").text(),
                                        product: $(index).find("HHDVu>THHDVu").text(),
                                        unit: $(index).find("HHDVu>DVTinh").text(),
                                        money: (parseFloat($(index).find("HHDVu>DGia").text())).toString(),
                                        count: (parseFloat($(index).find("HHDVu>SLuong").text())).toString(),
                                        moneyDiscount: (parseFloat($(index).find("HHDVu>STCKhau").text())).toString(),
                                        vat: $(index).find("HHDVu>TSuat").text(),
                                        vatMoney: (parseFloat($(index).find("TTin>DLieu").text())).toString(),
                                        total: (parseFloat($(index).find("HHDVu>ThTien").text())).toString(),
                                    })
                                    stt = parseInt(stt + 1);
                                });
                                $('#excelTable').DataTable().destroy();
                                // $('tbody').html();
                                listHHDVu && listHHDVu.map((item, index) => {
                                    var tienthue = parseInt((item.vat).replace('%', ''));
                                    var tienSauCK = parseFloat(item.count * item.money - item.moneyDiscount);
                                    var tienVat = parseFloat(item.count * item.money * parseFloat(tienthue / 100));
                                    $('tbody').append(
                                        "<tr> <td>" + item.no + "</td>\
                                    <td>" + item.number + "</td>\
                                    <td>" + item.symbol + "</td>\
                                    <td>" + item.date + "</td>\
                                    <td>" + item.supplier + "</td>\
                                    <td>" + item.address + "</td>\
                                    <td>" + item.type + "</td>\
                                    <td>" + item.product + "</td>\
                                    <td>" + item.unit + "</td>\
                                    <td>" + item.count + "</td>\
                                    <td>" + parseFloat(item.money).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + parseFloat(item.count * item.money).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + item.moneyDiscount + "</td>\
                                    <td>" + parseFloat(tienSauCK).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + item.vat + "</td>\
                                    <td>" + parseFloat(tienVat).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + parseFloat(tienSauCK + tienVat.toFixed(2)).toLocaleString("en-US") + "</td> </tr>")
                                })
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
                                    '<a href="#" class="list-group-item list-group-item-action">' + event.target.files[i].name + '</a>'
                                );
                                $('#countError').text(error);
                            }
                        } else {
                            error += 1;
                            $('#listFileError').append(
                                '<a href="#" class="list-group-item list-group-item-action">' + event.target.files[i].name + '</a>'
                            );
                            $('#countError').text(error);
                        }
                    }
                }

            })
        })
    </script>
</body>

</html>