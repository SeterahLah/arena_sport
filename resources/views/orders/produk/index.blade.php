@include('layout.head')
@include('layout.navbar')

<br><br><br><br>

<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Proses Checkout</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">

        <div class="row billing-fields">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <div class="create-ac-content bg-light-gray padding-20px-all">
                    {{--  --}}
                    <form action="{{ route('check') }}" method="POST">
                        @csrf
                        <fieldset>
                            <h2 class="login-title mb-3">Billing details</h2>
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="input-firstname">Nama Lengkap<span class="text-danger">*</span></label>
                                    <input name="nama" id="input-firstname" type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-6 required">
                                    <label for="input-lastname">Email<span class="text-danger">*</span></label>
                                    <input name="email" id="input-lastname" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="input-email">No. Handphone/WA <span class="text-danger">*</span></label>
                                    <input name="telepon" id="input-email" type="tel" class="form-control">
                                </div>
                                <div class="form-group col-md-6 required">
                                    <label for="origin_province">Provinsi Asal <span
                                            class="text-danger">*</span></label>
                                    <select name="origin_province" id="origin_province" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="origin_city">Kota Asal<span class="text-danger">*</span></label>
                                    <select id="origin_city" name="origin_city" class="form-control">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 required">
                                    <label for="input-telephone">Alamat Lengkap<span
                                            class="text-danger">*</span></label>
                                    <input name="alamat" id="input-telephone" type="text" class="form-control">
                                    <small>Silakan masukkan alamat detail seperti RT/RW dan patokan.</small>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="destination_province">Provinsi Tujuan <span
                                            class="text-danger">*</span></label>
                                    <select name="destination_province" id="destination_province" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 required">
                                    <label for="destination_city">Kota Tujuan<span class="text-danger">*</span></label>
                                    <select id="destination_city" name="destination_city" class="form-control">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="courier">Kurir</label>
                                    <select id="courier" name="courier" class="form-control">
                                        <option value="">--- Pilih Ekspedisi ---</option>
                                        <option value="jne">JNE</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS Indonesia</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 required">
                                    <label for="shipping_cost">Ongkos Kirim</label>
                                    <input type="text" id="shipping_cost" name="shipping_cost" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="input-company">Catatan Pesanan</label>
                                    <textarea class="form-control resize-both" rows="3" name="catatan"></textarea>
                                    <small>Masukkan catatan tambahan jika diperlukan.</small>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="your-order-payment">
                    <div class="your-order">
                        <h2 class="order-title mb-4">Pesanan Anda</h2>
                        <div class="table-responsive-sm order-table">
                            <table class="bg-white table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $value)
                                        <tr>
                                            <td>{{ $value->produk->nama }}</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>${{ $value->harga }}</td>
                                            <td id="subtotal_result">${{ $value->quantity * $value->harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="font-weight-600">
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td id="total_result">Rp. </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <hr />

                    <div class="your-payment">
                        <h2 class="payment-title mb-3">payment method</h2>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion" class="payment-section">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseOne">Direct
                                                Bank Transfer </a>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Make your payment directly into our bank
                                                    account. Please use your Order ID as the payment reference. Your
                                                    order won't be shipped until the funds have cleared in our account.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse"
                                                href="#collapseTwo">Cheque Payment</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Please send your cheque to Store Name,
                                                    Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card margin-15px-bottom border-radius-none">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse"
                                                href="#collapseThree"> PayPal </a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Pay via PayPal; you can pay with your
                                                    credit card if you don't have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse"
                                                href="#collapseFour"> Payment Information </a>
                                        </div>
                                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-cardname">Name on Card <span
                                                                    class="required-f">*</span></label>
                                                            <input name="cardname" value=""
                                                                placeholder="Card Name" id="input-cardname"
                                                                class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-country">Credit Card Type <span
                                                                    class="required-f">*</span></label>
                                                            <select name="country_id" class="form-control">
                                                                <option value=""> --- Please Select --- </option>
                                                                <option value="1">American Express</option>
                                                                <option value="2">Visa Card</option>
                                                                <option value="3">Master Card</option>
                                                                <option value="4">Discover Card</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-cardno">Credit Card Number <span
                                                                    class="required-f">*</span></label>
                                                            <input name="cardno" value=""
                                                                placeholder="Credit Card Number" id="input-cardno"
                                                                class="form-control" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-cvv">CVV Code <span
                                                                    class="required-f">*</span></label>
                                                            <input name="cvv" value=""
                                                                placeholder="Card Verification Number" id="input-cvv"
                                                                class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label>Expiration Date <span
                                                                    class="required-f">*</span></label>
                                                            <input type="date" name="exdate"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <img class="padding-25px-top xs-padding-5px-top"
                                                                src="assets/images/payment-img.jpg" alt="card"
                                                                title="card" />
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-button-payment">
                                <button class="btn" value="Place order" type="submit">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- provinsi dan kota --}}
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function fetchProvinces(selectElementId) {
            fetch('/provinces')
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Pilih Provinsi</option>';
                    data.rajaongkir.results.forEach(province => {
                        options += `<option value="${province.province_id}">${province.province}</option>`;
                    });
                    document.getElementById(selectElementId).innerHTML = options;
                });
        }

        function fetchCities(provinceSelectId, citySelectId) {
            document.getElementById(provinceSelectId).addEventListener("change", function() {
                let provinceId = this.value;
                fetch(`/cities/${provinceId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Pilih Kota</option>';
                        data.rajaongkir.results.forEach(city => {
                            options += `<option value="${city.city_id}">${city.city_name}</option>`;
                        });
                        document.getElementById(citySelectId).innerHTML = options;
                    });
            });
        }

        function calculateSubtotal() {
            let subtotals = document.querySelectorAll("#subtotal_result");
            let totalSubtotal = 0;

            subtotals.forEach(subtotal => {
                totalSubtotal += parseFloat(subtotal.textContent.replace(/[^0-9.-]+/g, "")) || 0;
            });

            return totalSubtotal;
        }

        function updateTotal() {
            let subtotal = calculateSubtotal();
            let shippingCost = parseFloat(document.getElementById("shipping_cost").value.replace(/[^0-9.-]+/g, "")) || 0;
            let total = subtotal + shippingCost;

            document.getElementById("total_result").textContent = "Rp " + total.toLocaleString();
        }

        function getShippingCost() {
            let destination = document.getElementById("destination_city").value;
            let courier = document.getElementById("courier").value;

            if (destination && courier) {
                fetch('/shipping-cost', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            destination: destination,
                            courier: courier
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        let results = data.rajaongkir.results;
                        if (results.length > 0) {
                            let cost = results[0].costs[0].cost[0].value;
                            document.getElementById("shipping_cost").value = "Rp " + cost;
                        } else {
                            document.getElementById("shipping_cost").value = "Data tidak tersedia";
                        }
                        updateTotal(); // Perbarui total setelah ongkos kirim didapat
                    })
                    .catch(error => {
                        document.getElementById("shipping_cost").value = "Gagal mengambil data";
                        updateTotal();
                    });
            } else {
                document.getElementById("shipping_cost").value = "";
                updateTotal();
            }
        }

        // Load data provinsi & kota
        fetchProvinces("origin_province");
        fetchProvinces("destination_province");

        fetchCities("origin_province", "origin_city");
        fetchCities("destination_province", "destination_city");

        // Hitung subtotal awal
        updateTotal();

        // Hitung ongkos kirim otomatis saat kota tujuan atau kurir berubah
        document.getElementById("destination_city").addEventListener("change", getShippingCost);
        document.getElementById("courier").addEventListener("change", getShippingCost);
    });
</script>


</div>
<!--End Body Content-->
@include('layout.footer')
