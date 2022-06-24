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
            $("#formFileMultiple").change(function(event) {
                $('#excelTable').DataTable().destroy();
                $('tbody').html('')
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
                                var dateInvoice = (ngayhdon.replace('/', '-')).split('-');
                                var tchdon = $(xmlDoc).find("TTHDLQuan>TCHDon").text();
                                var htttoan = $(xmlDoc).find("TTChung>HTTToan").text();
                                if(tchdon === "1") tchdon = "Thay thế";
                                else if(tchdon === "2") tchdon = "Điều chỉnh";
                                $(xmlDoc).find("HHDVu").map((item, index) => {
                                    listHHDVu.push({
                                        no: parseInt(stt + 1),
                                        number: mshdon,
                                        numberInvoice: shdon,
                                        symbol: khhdon,
                                        date: dateInvoice[2] + '/' + dateInvoice[1] + '/' + dateInvoice[0],
                                        codeTax: mst,
                                        supplier: ncc,
                                        address: diachi,
                                        type: $(index).find("HHDVu>TChat").text(),
                                        typeInvoice: tchdon,
                                        product: $(index).find("HHDVu>THHDVu").text(),
                                        unit: $(index).find("HHDVu>DVTinh").text(),
                                        money: (parseFloat($(index).find("HHDVu>DGia").text())).toString(),
                                        count: (parseFloat($(index).find("HHDVu>SLuong").text())).toString(),
                                        moneyDiscount: (parseFloat($(index).find("HHDVu>STCKhau").text())).toString(),
                                        vat: $(index).find("HHDVu>TSuat").text(),
                                        vatMoney: (parseFloat($(index).find("TTin>DLieu").text())).toString(),
                                        total: (parseFloat($(index).find("HHDVu>ThTien").text())).toString(),
                                        payment: htttoan,
                                    })
                                    stt = parseInt(stt + 1);
                                });
                                $('#excelTable').DataTable().destroy();
                                // $('tbody').html();
                                listHHDVu && listHHDVu.map((item, index) => {
                                    var tienCK = item.moneyDiscount;
                                    if (isNaN(item.moneyDiscount)) tienCK = 0;
                                    var tienthue = parseInt((item.vat).replace('%', ''));
                                    var tienSauCK = parseFloat(item.count * item.money - tienCK);
                                    var tienVat = parseFloat(tienSauCK * parseFloat(tienthue / 100));
                                    $('tbody').append(
                                        "<tr> <td>" + item.no + "</td>\
                                    <td>" + item.number + "</td>\
                                    <td>" + item.symbol + "</td>\
                                    <td>" + item.numberInvoice + "</td>\
                                    <td>" + item.typeInvoice + "</td>\
                                    <td>" + item.date + "</td>\
                                    <td>" + item.codeTax + "</td>\
                                    <td>" + item.supplier + "</td>\
                                    <td>" + item.address + "</td>\
                                    <td>" + item.type + "</td>\
                                    <td>" + item.product + "</td>\
                                    <td>" + item.payment + "</td>\
                                    <td>" + item.unit + "</td>\
                                    <td>" + item.count + "</td>\
                                    <td>" + parseFloat(item.money).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td style='background-color:#b3e6ff;'>" + parseFloat(item.total).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td style='background-color:#ffd9b3;'>" + parseFloat(item.count * item.money).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + item.moneyDiscount + "</td>\
                                    <td>" + parseFloat(tienSauCK).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + parseFloat(tienSauCK / item.count).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + item.vat + "</td>\
                                    <td>" + parseFloat(tienVat).toFixed(2).toLocaleString("en-US") + "</td>\
                                    <td>" + parseFloat(tienSauCK + tienVat).toFixed(2).toLocaleString("en-US") + "</td> </tr>")
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