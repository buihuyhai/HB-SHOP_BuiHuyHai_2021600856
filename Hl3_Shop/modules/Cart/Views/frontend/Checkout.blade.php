    @extends('Layout::frontend.app')
    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @csrf
        <div class="checkout-area pt-60 pb-30">
            <div class="container">
                @if (Auth::check())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="your-order">
                                <h3 style="border: none" class="mb-10">Đơn hàng của bạn</h3>
                                <div class="your-order-table table-responsive">
                                    <table class="table border">
                                        <tr>
                                            <th class="cart-product-shop">Shop</th>
                                            <th colspan="2" class="cart-product-name">Sản phẩm</th>
                                            <th class="cart-product-name">Số lượng</th>
                                            <th class="cart-product-total">Tổng giá</th>
                                        </tr>
                                        <tbody id="order_items">
                                            @foreach ($groupedItems as $shopName => $shopDetails)
                                                <tr class="cart_item">
                                                    <td class="border align-middle"
                                                        rowspan="{{ count($shopDetails['items']) + 1 }}">
                                                        {{ $shopName }}
                                                    </td>
                                                    @foreach ($shopDetails['items'] as $item)
                                                        <td colspan="2" class="cart-product-name text-start">
                                                            {{ $item['product']['name'] }}
                                                        </td>
                                                        <td class="cart-product-quantity">
                                                            {{ $item['quantity'] }}
                                                        </td>
                                                        <td class="cart-product-total">
                                                            <span class="amount">{{ number_format($item['total_price']) }}₫
                                                            </span>
                                                        </td>
                                                </tr>
                                            @endforeach
                                            <tr class="cart-product-coupon">
                                                <td colspan="3" class="align-middle">
                                                    <form class="apply-coupon-form text-end"
                                                        data-shop-id="{{ $shopDetails['shop_id'] }}">
                                                        <input type="text" class="border" name="coupon_code"
                                                            placeholder="Nhập mã coupon">
                                                        <button type="submit">Áp dụng</button>
                                                    </form>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="total-shop mb-0"
                                                        id="shop-total-{{ $shopDetails['shop_id'] }}">
                                                        <span
                                                            class="total_price_shop">{{ number_format($shopDetails['total_price'], 0, ',', '.') }}₫</span><br>
                                                        <span class="total-price-shop"></span>
                                                    </p>
                                                </td>
                                            </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr class="order-total">
                        <td colspan="3" style="text-align: end;vertical-align: middle;">
                            <strong style="font-size: 1rem">Tổng đơn hàng</strong>
                        </td>
                        <td colspan="3" style="text-align: end; padding-right: 100px">
                            <strong><span class="amount">{{ number_format($totalPrice) }}₫</span></strong>
                            <strong><span class="amount-ver2"></span></strong>
                        </td>
                    </tr>
                </tfoot>
                </table>
            </div>

            <div class="payment-method">

                <div class="row">
                    <div class="col-md-7">
                        <div class="col-lg-12">
                            <form id="checkout_form" action="#">
                                <div class="checkbox-form row">
                                    <div class="col-md-12">
                                        <h3>Địa chỉ nhận hàng</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkout-form-list">
                                            <label>Tỉnh/Thành Phố<span class="required">*</span></label>
                                            <select class="nice-select col-12 mb-15" id="province" name="province"
                                                required>
                                                <option class="col-12" value="">Chọn Tỉnh/Thành Phố</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkout-form-list">
                                            <label>Quận/Huyện<span class="required">*</span></label>
                                            <select class="nice-select col-12 mb-15" id="district" name="district"
                                                required>
                                                <option class="col-12" value="">Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkout-form-list">
                                            <label>Phường/Xã<span class="required">*</span></label>
                                            <select class="nice-select col-12 mb-15" id="ward" name="ward" required>
                                                <option class="col-12" value="">Chọn Phường/Xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-15">
                                            <label>Địa chỉ<span class="required"></span></label>
                                            <input type="text" id="address" name="address" placeholder="Số nhà, Đường"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-15">
                                            <label>Địa chỉ đầy đủ<span class="required">*</span></label>
                                            <input type="text" name="full_address"
                                                placeholder="Nhập địa chỉ cụ thể của bạn" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Số điện thoại<span class="required">*</span></label>
                                            <input value="{{ $checkout->users->phone }}" type="text" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email<span class="required">*</span></label>
                                            <input value="{{ $checkout->users->email }}" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="different-address col-md-12">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Ghi chú!</label>
                                                <textarea id="checkout-mess" style="resize: none;" name="description" placeholder="Lưu ý cho người bán"
                                                    class="col-md-12 bg-white text-dark"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="payment-accordion col-md-5">
                        <div class="col-md-12">
                            <h3>Phương thức thanh toán</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment1"
                                    value="COD" checked>
                                <label class="form-check-label" for="payment1">
                                    Thanh toán khi nhận hàng
                                </label>
                                <div id="payment1-info" class="payment-info" style="display: block;">
                                    <p>Thanh toán trực tiếp sau khi kiểm tra hàng.</p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment2"
                                    value="credit">
                                <label class="form-check-label" for="payment2">
                                    Thanh toán tín dụng
                                </label>
                                <div id="payment2-info" class="payment-info" style="display: none;">
                                    <img style="opacity: 0.5;cursor:no-drop"
                                        src="{{ asset('frontend/assets/images/payment/1.png') }}" alt="Thẻ tín dụng">
                                </div>
                            </div>
                            <br>
                            <div class="order-button-payment">
                                <button type="submit" id="order-button"
                                    style="color:white;border:none;background:#069155;width: 100%;cursor: pointer;text-align:center; padding: .8rem;">
                                    <b>Đặt Hàng</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        @endif
        </div>

        </div>
    @endsection

    @push('js')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            //     $(document).ready(function() {
            //         $('#')
            //         toastr.options = {
            //             "closeButton": true,
            //             "debug": false,
            //             "newestOnTop": true,
            //             "progressBar": true,
            //             "positionClass": "toast-top-center",
            //             "preventDuplicates": false,
            //             "onclick": null,
            //             "showDuration": "300",
            //             "hideDuration": "1000",
            //             "timeOut": "1500",
            //             "extendedTimeOut": "1000",
            //             "showEasing": "swing",
            //             "hideEasing": "linear",
            //             "showMethod": "fadeIn",
            //             "hideMethod": "fadeOut"
            //         };
            //     })
            //     $(document).ready(function() {
            //         let style = document.createElement('style');
            //         style.innerHTML = `
    // .nice-select .list {
    //     max-height: 200px !important;
    //     overflow-y: auto !important;
    //     overflow-x: hidden !important;
    // }
    //     .nice-select ul{
    //         width:100% !important;
    //     }`;
            //         document.head.appendChild(style);

            //         // Initialize nice-select on document ready
            //         $('select.nice-select').niceSelect();

            //         // Function to fetch provinces and update the select element
            //         const fetchProvinces = async () => {
            //             try {
            //                 const response = await fetch("{{ route('api.provinces') }}");
            //                 if (!response.ok) throw new Error('Network response was not ok.');
            //                 const data = await response.json();
            //                 if (data.success) {
            //                     renderOptions(data.provinces, "province");
            //                 } else {
            //                     toastr.error('Không thể tải danh sách tỉnh/thành phố.');
            //                 }
            //             } catch (error) {
            //                 toastr.error('Không thể tải danh sách tỉnh/thành phố.');
            //             }
            //         };

            //         // Function to fetch districts based on province code and update the select element
            //         const fetchDistricts = async (provinceCode) => {
            //             try {
            //                 if (!provinceCode) return;
            //                 const response = await fetch("{{ route('api.districts') }}", {
            //                     method: 'POST',
            //                     headers: {
            //                         'Content-Type': 'application/json',
            //                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
            //                             .getAttribute(
            //                                 'content')
            //                     },
            //                     body: JSON.stringify({
            //                         province_code: provinceCode
            //                     })
            //                 });
            //                 if (!response.ok) throw new Error('Network response was not ok.');
            //                 const data = await response.json();
            //                 if (data.success) {
            //                     renderOptions(data.districts, "district");
            //                 } else {
            //                     toastr.error('Không thể tải danh sách quận/huyện.');
            //                 }
            //             } catch (error) {
            //                 toastr.error('Không thể tải danh sách quận/huyện.');
            //             }
            //         };

            //         // Function to fetch wards based on district code and update the select element
            //         const fetchWards = async (districtCode) => {
            //             try {
            //                 if (!districtCode) return;
            //                 const response = await fetch("{{ route('api.wards') }}", {
            //                     method: 'POST',
            //                     headers: {
            //                         'Content-Type': 'application/json',
            //                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
            //                             .getAttribute(
            //                                 'content')
            //                     },
            //                     body: JSON.stringify({
            //                         district_code: districtCode
            //                     })
            //                 });
            //                 if (!response.ok) throw new Error('Network response was not ok.');
            //                 const data = await response.json();
            //                 if (data.success) {
            //                     renderOptions(data.wards, "ward");
            //                 } else {
            //                     toastr.error('Không thể tải danh sách phường/xã.');
            //                 }
            //             } catch (error) {
            //                 toastr.error('Không thể tải danh sách phường/xã.');
            //             }
            //         };
            //         document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
            //             elem.addEventListener('change', function() {
            //                 document.querySelectorAll('.payment-info').forEach((info) => {
            //                     info.style.display = 'none'; // Ẩn tất cả các thông tin thanh toán
            //                 });
            //                 const selectedPayment = document.querySelector(
            //                         'input[name="payment_method"]:checked')
            //                     .value;
            //                 document.querySelector(`#payment${selectedPayment === 'COD' ? '1' : '2'}-info`)
            //                     .style
            //                     .display = 'block'; // Hiển thị thông tin của phương thức thanh toán đã chọn
            //             });
            //         });
            //         // Function to render options into select elements
            //         const renderOptions = (data, selectId) => {
            //             let options = '<option value="">Chọn</option>';
            //             data.forEach(element => {
            //                 options += `<option value="${element.code}">${element.name}</option>`;
            //             });
            //             const selectElement = $(`#${selectId}`);
            //             selectElement.html(options);
            //             selectElement.niceSelect('update'); // Update nice-select after changing options
            //         };

            //         // Event listeners for province, district, and ward selects
            //         $("#province").on("change", function() {
            //             const provinceCode = this.value;
            //             fetchDistricts(provinceCode);
            //             updateFullAddress();
            //         });

            //         $("#district").on("change", function() {
            //             const districtCode = this.value;
            //             fetchWards(districtCode);
            //             updateFullAddress();
            //         });

            //         $("#ward").on("change", function() {
            //             updateFullAddress();
            //         });

            //         // Function to update the full address
            //         const updateFullAddress = () => {
            //             const fullAddressInput = $('input[name="full_address"]');

            //             const setFullAddress = () => {
            //                 const province = $('#province option:selected').text();
            //                 const district = $('#district option:selected').text();
            //                 const ward = $('#ward option:selected').text();
            //                 const address = $('#address').val();

            //                 fullAddressInput.val(`${address}, ${ward}, ${district}, ${province}`);
            //             };

            //             // Update full address when address input changes
            //             $("#address").on("input", setFullAddress);

            //             // Set initial full address based on current selections
            //             setFullAddress();
            //         };

            //         // Initialize the page by fetching provinces and setting up event listeners
            //         fetchProvinces();
            //         updateFullAddress();
            //     });
            $(document).ready(function() {
                // Toastr config
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-center",
                    timeOut: "1500"
                };

                // Custom style for dropdown scroll
                let style = document.createElement('style');
                style.innerHTML = `
            .nice-select .list {
                max-height: 200px !important;
                overflow-y: auto !important;
                overflow-x: hidden !important;
            }
            .nice-select ul {
                width: 100% !important;
            }`;
                document.head.appendChild(style);

                $('select.nice-select').niceSelect();

                // Check if element is manual input
                const isManualInput = (id) => {
                    return $(`#${id}`).prop('tagName').toLowerCase() === 'input';
                };

                // Replace select with text input
                const replaceSelectWithInput = (id, placeholder) => {
                    const old = $(`#${id}`);
                    const value = old.val() || '';
                    const input = $(
                        `<input type="text" id="${id}" name="${id}" class="form-control" placeholder="${placeholder}" value="${value}"/>`
                    );
                    old.parent().html(input);
                };

                // Replace all selects with manual input
                const fallbackToManualAddressInput = () => {
                    replaceSelectWithInput('province', 'Nhập tỉnh/thành phố');
                    replaceSelectWithInput('district', 'Nhập quận/huyện');
                    replaceSelectWithInput('ward', 'Nhập phường/xã');
                };

                // Render options to select
                const renderOptions = (data, selectId) => {
                    let options = '<option value="">Chọn</option>';
                    data.forEach(item => {
                        options += `<option value="${item.code}">${item.name}</option>`;
                    });
                    const select = $(`#${selectId}`);
                    select.html(options);
                    select.niceSelect('update');
                };

                // Fetch province
                const fetchProvinces = async () => {
                    try {
                        const response = await fetch("{{ route('api.provinces') }}");
                        if (!response.ok) throw new Error('Lỗi mạng');
                        const data = await response.json();
                        if (data.success) {
                            renderOptions(data.provinces, 'province');
                        } else {
                            throw new Error('Không thành công');
                        }
                    } catch (error) {
                        toastr.error('Không thể tải danh sách tỉnh/thành phố.');
                        fallbackToManualAddressInput(); // Lỗi => Chuyển cả 3 sang nhập tay
                    }
                };

                // Fetch district
                const fetchDistricts = async (provinceCode) => {
                    try {
                        if (!provinceCode || isManualInput('province')) return;
                        const response = await fetch("{{ route('api.districts') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                province_code: provinceCode
                            })
                        });
                        if (!response.ok) throw new Error('Lỗi mạng');
                        const data = await response.json();
                        if (data.success) {
                            renderOptions(data.districts, 'district');
                        } else {
                            throw new Error('Không thành công');
                        }
                    } catch (error) {
                        toastr.error('Không thể tải danh sách quận/huyện.');
                        replaceSelectWithInput('district', 'Nhập quận/huyện');
                    }
                };

                // Fetch ward
                const fetchWards = async (districtCode) => {
                    try {
                        if (!districtCode || isManualInput('district')) return;
                        const response = await fetch("{{ route('api.wards') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                district_code: districtCode
                            })
                        });
                        if (!response.ok) throw new Error('Lỗi mạng');
                        const data = await response.json();
                        if (data.success) {
                            renderOptions(data.wards, 'ward');
                        } else {
                            throw new Error('Không thành công');
                        }
                    } catch (error) {
                        toastr.error('Không thể tải danh sách phường/xã.');
                        replaceSelectWithInput('ward', 'Nhập phường/xã');
                    }
                };

                // Update full address input
                const updateFullAddress = () => {
                    const fullAddressInput = $('input[name="full_address"]');

                    const getTextValue = (id) => {
                        const el = $(`#${id}`);
                        return el.length ? el.val() || el.find(':selected').text() : '';
                    };

                    const setFullAddress = () => {
                        const province = getTextValue('province');
                        const district = getTextValue('district');
                        const ward = getTextValue('ward');
                        const address = $('#address').val();
                        fullAddressInput.val(`${address}, ${ward}, ${district}, ${province}`);
                    };

                    $('#province, #district, #ward, #address').on('input change', setFullAddress);
                    setFullAddress();
                };

                // Event listeners
                $(document).on('change', '#province', function() {
                    const provinceCode = $(this).val();
                    fetchDistricts(provinceCode);
                    updateFullAddress();
                });

                $(document).on('change', '#district', function() {
                    const districtCode = $(this).val();
                    fetchWards(districtCode);
                    updateFullAddress();
                });

                $(document).on('change', '#ward', function() {
                    updateFullAddress();
                });

                // Init
                fetchProvinces();
                updateFullAddress();
            });


            $(document).ready(function() {
                var cartItems = @json($groupedItems);

                $('.apply-coupon-form').on('submit', function(e) {
                    e.preventDefault();

                    var form = $(this);
                    var couponCode = form.find('input[name="coupon_code"]').val();
                    var shopId = form.data('shop-id');
                    var shopName = '';
                    $.each(cartItems, function(name, shop) {
                        if (shop.shop_id == shopId) {
                            shopName = name;
                            return false;
                        }
                    });

                    if (shopName) {
                        var shopItems = cartItems[shopName];

                        $.ajax({
                            url: '{{ route('apply-coupon') }}',
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: JSON.stringify({
                                coupon_code: couponCode,
                                cart_items: shopItems
                            }),
                            success: function(response) {
                                if (response.success) {

                                    updateDiscounts(response.discountedTotal, shopId);
                                    updateTotalOrderPrice();

                                } else {
                                    toastr.error(response.message || 'Đã xảy ra lỗi!.');
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Mã giảm giá không hợp lệ!.');
                            }
                        });
                    } else {
                        toastr.error('No cart items found for shop ID:', shopId);
                    }
                });

                function updateDiscounts(discountedTotal, shopId) {
                    if (discountedTotal) {
                        var newTotal = discountedTotal;
                        $('#shop-total-' + shopId + ' .total-price-shop').text(number_format(newTotal));
                        $('#shop-total-' + shopId + ' .total_price_shop').css('text-decoration', 'line-through').css(
                            'color', 'red');
                    } else {
                        toastr.error('No discounted price found for shop ID:', shopId);
                    }
                }

                function updateTotalOrderPrice() {
                    var totalOrderPrice = 0;
                    $.each(cartItems, function(name, shop) {
                        var shopId = shop.shop_id;
                        var shopTotal = parseFloat($('#shop-total-' + shopId + ' .total-price-shop').text()
                            .replace(/[^0-9]/g, ''));
                        if (isNaN(shopTotal)) {
                            shopTotal = parseFloat($('#shop-total-' + shopId + ' .total_price_shop').text()
                                .replace(/[^0-9]/g, ''));
                        }
                        if (!isNaN(shopTotal)) {
                            totalOrderPrice += shopTotal;
                        }
                    });
                    // Update the total order price display
                    $('.order-total .amount').css('text-decoration', 'line-through').css('color', 'red');
                    $('.order-total .amount-ver2').text(number_format(totalOrderPrice));
                }

                function number_format(amount) {
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(amount);
                }
            });

            var groupedItems = @json($groupedItems);

            // function submitOrders() {
            //     var form = $('#checkout_form');
            //     const province = form.find('select[name="province"]').val();
            //     const district = form.find('select[name="district"]').val();
            //     const ward = form.find('select[name="ward"]').val();
            //     const address = form.find('input[name="full_address"]').val();
            //     const phone = form.find('input[name="phone"]').val();
            //     const email = form.find('input[name="email"]').val();
            //     const description = form.find('textarea[name="description"]').val();

            //     if (!province || !district || !ward) {
            //         toastr.error("Vui lòng nhập đầy đủ các trường bắt buộc");
            //         return;
            //     }

            //     let formData = new FormData();
            //     let coupons = [];
            //     let detail = [];

            //     Object.keys(groupedItems).forEach((shopName, shopIndex) => {
            //         const shop = groupedItems[shopName];
            //         const couponCode = $('.apply-coupon-form[data-shop-id="' + shop.shop_id +
            //             '"] input[name="coupon_code"]').val();

            //         if (couponCode) {
            //             $.ajax({
            //                 url: '/get-coupon-id',
            //                 method: 'POST',
            //                 async: false,
            //                 data: {
            //                     coupon_code: couponCode,
            //                     _token: '{{ csrf_token() }}'
            //                 },
            //                 success: function(response) {
            //                     coupons.push({
            //                         shop_id: shop.shop_id,
            //                         coupon_id: response.coupon_id
            //                     });
            //                 },
            //                 error: function(error) {
            //                     toastr.error("Lỗi khi lấy coupon_id cho shop ID " + shop.shop_id);
            //                 }
            //             });
            //         }

            //         shop.items.forEach((item, itemIndex) => {
            //             detail.push({
            //                 product_variant_id: item.product_variant_id,
            //                 quantity: item.quantity
            //             });
            //             formData.append('carts[]', item.cart_products_id);
            //         });
            //     });

            //     formData.append('email', email);
            //     formData.append('address', address);
            //     formData.append('phone_number', phone);
            //     formData.append('description', description);
            //     formData.append('coupons', JSON.stringify(coupons));
            //     formData.append('detail', JSON.stringify(detail));

            //     $.ajax({
            //         url: '{{ route('checkout') }}',
            //         method: 'POST',
            //         dataType: 'json',
            //         contentType: false,
            //         data: formData,
            //         processData: false,
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             toastr.success('Đặt hàng thành công!!');
            //             setTimeout(() => {
            //                 window.location.href = '{{ route('user.order') }}';
            //             }, 1500);
            //         },
            //         error: function(xhr, status, error) {
            //             toastr.error('Có lỗi khi đặt hàng');
            //         }
            //     });
            // }
            function submitOrders() {
                var form = $('#checkout_form');

                // 👇 Hàm lấy giá trị tỉnh/quận/xã kể cả là select hay input
                const getFieldValue = (form, name) => {
                    const input = form.find(`[name="${name}"]`);
                    if (input.length === 0) return '';
                    return input.val();
                };

                const province = getFieldValue(form, 'province');
                const district = getFieldValue(form, 'district');
                const ward = getFieldValue(form, 'ward');
                const address = form.find('input[name="full_address"]').val();
                const phone = form.find('input[name="phone"]').val();
                const email = form.find('input[name="email"]').val();
                const description = form.find('textarea[name="description"]').val();

                if (!province || !district || !ward || !address || !phone || !email) {
                    toastr.error("Vui lòng nhập đầy đủ các trường bắt buộc");
                    return;
                }

                let formData = new FormData();
                let coupons = [];
                let detail = [];

                Object.keys(groupedItems).forEach((shopName, shopIndex) => {
                    const shop = groupedItems[shopName];
                    const couponCode = $('.apply-coupon-form[data-shop-id="' + shop.shop_id +
                        '"] input[name="coupon_code"]').val();

                    if (couponCode) {
                        $.ajax({
                            url: '/get-coupon-id',
                            method: 'POST',
                            async: false,
                            data: {
                                coupon_code: couponCode,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                coupons.push({
                                    shop_id: shop.shop_id,
                                    coupon_id: response.coupon_id
                                });
                            },
                            error: function(error) {
                                toastr.error("Lỗi khi lấy coupon_id cho shop ID " + shop.shop_id);
                            }
                        });
                    }

                    shop.items.forEach((item, itemIndex) => {
                        detail.push({
                            product_variant_id: item.product_variant_id,
                            quantity: item.quantity
                        });
                        formData.append('carts[]', item.cart_products_id);
                    });
                });

                formData.append('email', email);
                formData.append('address', address);
                formData.append('phone_number', phone);
                formData.append('description', description);
                formData.append('coupons', JSON.stringify(coupons));
                formData.append('detail', JSON.stringify(detail));

                $.ajax({
                    url: '{{ route('checkout') }}',
                    method: 'POST',
                    dataType: 'json',
                    contentType: false,
                    data: formData,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('Đặt hàng thành công!!');
                        setTimeout(() => {
                            window.location.href = '{{ route('user.order') }}';
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Có lỗi khi đặt hàng');
                    }
                });
            }

            document.getElementById('order-button').addEventListener('click', submitOrders);
        </script>
    @endpush
