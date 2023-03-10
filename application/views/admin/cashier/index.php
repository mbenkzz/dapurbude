<!DOCTYPE html>
<html lang="id">

<head>
  <?php $this->load->view('admin/template-parts/head') ?>
  <style>
    .badge-stock,
    .badge-price {
      border-radius: 0
    }

    .text-monospace {
      font-family: 'Courier New', Courier, monospace !important;
      font-weight: 700;
    }

    .item-list-header,
    .item-list-footer {
      font-weight: bold;
      background-color: #f8f9fa;
    }

    #cart_subtotal,
    #cart_total {
      font-weight: bold;
      margin-top: auto;
      margin-bottom: auto;
    }

    #cart_subtotal {
      font-size: 1.25rem;
    }

    #cart_total {
      font-size: 1.5rem;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <?php $this->load->view('admin/template-parts/header') ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <?php $this->load->view('admin/template-parts/sidebar') ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <!-- check flash session transaction_id and show success alert -->
          <?php if ($this->session->flashdata('transaction_id')) : ?>
            <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
              <strong>Transaksi <?= $this->session->flashdata('transaction_code') ?> berhasil!</strong> <a href="<?= admin_url('transaction/print/' . $this->session->flashdata('transaction_id')) ?>" target="_blank" class="alert-link">Klik untuk melihat struk</a>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif ?>
          <div class="card my-4">
            <div class="card-header">
              <i class="fas fa-table mr-1"></i>
              Kasir
            </div>
            <div class="card-body pb-0">
              <div id="add_barang_form" class="row">
                <div class="col-md-6 mb-3">
                  <!-- select items -->
                  <select id="add_barang_item" class="form-control"></select>
                  <small class="text-danger"></small>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-secondary add_barang_amount_modifier" type="button" data-action="minus" disabled><i class="fas fa-minus"></i></button>
                    </div>
                    <input type="text" class="form-control text-center" id="add_barang_amount" placeholder="Jumlah" data-min="0" disabled>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary add_barang_amount_modifier" type="button" data-action="plus" disabled><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                  <small class="text-danger"></small>
                </div>
                <div class="col-md-2 mb-3">
                  <button type="button" class="btn btn-primary btn-block" id="btn_add_item" disabled>
                    <i class="fas fa-cart-plus mr-1"></i>
                    <span class="d-inline d-sm-none d-xl-inline">Tambah</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?= admin_url('transaction/add') ?>" method="post" id="form_transaksi">
                <div class="item-list-header row border-top border-bottom py-2">
                  <div class="col-2">
                    <!-- checkbox -->
                    <input type="checkbox" class="mr-2" id="check_all_items">
                    <!-- item code -->
                    Kode
                  </div>
                  <div class="col-4">
                    <!-- item name -->
                    Barang
                  </div>
                  <div class="col-1 text-center">
                    <!-- item amount -->
                    <span class="d-none d-xl-block text-truncate">Jumlah</span>
                  </div>
                  <div class="col-2 text-right">
                    <!-- item price -->
                    Harga
                  </div>
                  <div class="col-2 text-right">
                    <!-- item total -->
                    Total
                  </div>
                </div>
                <div class="item-list"></div>
                <div class="row no-gutters">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    <div class="row item-list-footer invisible border py-2">
                      <div class="col-2"></div>
                      <div class="col-4 text-right">
                        Subtotal
                      </div>
                      <div class="col-6 col-md-4 text-right text-monospace" id="cart_subtotal">
                        1.410.000
                      </div>
                    </div>
                    <div class="row item-list-footer invisible border py-2">
                      <div class="col-2"></div>
                      <div class="col-4 text-right">
                        Diskon
                      </div>
                      <div class="col-6 col-md-4 text-right text-monospace" id="cart_discount">
                        <div class="input-group input-group-sm">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <input type="checkbox" id="cart_check_discount">
                            </div>
                          </div>
                          <input type="text" class="form-control text-right p-0 border-0 font-weight-bold" id="cart_input_discount" name="discount" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row item-list-footer invisible border" style="background-color: #dee2e6;">
                      <div class="col-2"></div>
                      <div class="col-4 text-right my-2">
                        Total
                      </div>
                      <div class="col-6 col-md-4 text-right text-monospace" id="cart_total">
                        1.410.000
                      </div>
                      <input type="hidden" name="total" id="cart_input_total">
                    </div>
                    <div class="row item-list-footer invisible border py-2" style="background-color: #dee2e6;">
                      <div class="col-2"></div>
                      <div class="col-4 text-right">
                        Bayar
                      </div>
                      <div class="col-6 col-md-4 text-right text-monospace">
                        <input type="text" class="form-control form-control-sm text-right p-0 border-0 font-weight-bold" id="cart_input_pay" name="paid">
                      </div>
                    </div>
                    <div class="row item-list-footer invisible border py-2">
                      <div class="col-2"></div>
                      <div class="col-4 text-right">
                        Kembali
                      </div>
                      <div class="col-6 col-md-4 text-right text-monospace" id="cart_change_money">
                        90.000
                      </div>
                      <input type="hidden" name="change" id="cart_input_change_money">
                    </div>
                    <!-- proceed button -->
                    <div class="row item-list-footer invisible border py-2">
                      <div class="col-4 col-xl-6"></div>
                      <div class="col-8 col-md-6 col-xl-4">
                        <button type="button" class="btn btn-primary btn-block" id="btn_proceed" disabled>
                          <i class="fas fa-check mr-1"></i>
                          <span>Proses</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
      <?php $this->load->view('admin/template-parts/footer') ?>
    </div>
  </div>
  <?php $this->load->view('admin/template-parts/scripts') ?>
  <script>
    var selectedItem = null;
    const cart_changes = new Event('cart_changes');
    $(document).ready(function() {
      $('.item-list').html('');
      $('#add_barang_item').select2({
        width: '100%',
        placeholder: 'Pilih barang',
        ajax: {
          url: '<?= admin_url('items/select2') ?>',
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              q: params.term,
              page: params.page
            };
          },
          processResults: function(data) {
            // return mapping of object
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.text,
                  disabled: parseFloat(item.stock) < 1,
                  code: item.code,
                  name: item.name,
                  stock: parseFloat(item.stock),
                  unit: item.unit,
                  price: parseFloat(item.price),
                }
              }),
            };
          },
          cache: false,
        },
        templateResult: function(item) {
          if (!item.loading) {
            let badge = '';

            let string_stock = item.stock.toString().replace('.', ',');
            let badge_class = (parseFloat(item.stock) > 0) ? 'badge-success' : 'badge-danger';
            badge = '<span class="badge ' + badge_class + ' badge-stock">' + string_stock + ' ' + item.unit + '</span>';
            var price_badge = '<span class="badge badge-primary badge-price"> Rp. ' + item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</span>';
            var html = '<div class="row no-gutters">';
            html += '<div class="col text-truncate" title="' + item.text + '">' + item.text + '</div>';
            html += '<div class="col-auto text-right">' + badge + price_badge + '</div>';
            html += '</div>';
            return html;
          }
        },
        templateSelection: function(item) {
          // thousands separator
          if (item.id == '') {
            return item.text;
          } else {
            var price = item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return item.name + ' (' + price + ')';
          }
        },
        escapeMarkup: (m) => {
          return m
        }
      });
    });

    $('#add_barang_item').on('select2:select', function(e) {
      selectedItem = e.params.data;
      $('#add_barang_item').next('small.text-danger').text('');

      amountDisabled(false);

      // check if item already in cart if not set amount back to one
      var item = $('.item-list').find('.item-row[data-code="' + selectedItem.code + '"]');
      if (item.length > 0) {
        // set amount input to item amount
        $('#add_barang_amount').val(item.find('.item-amount').text());
      } else {
        $('#add_barang_amount').val('');
      }

      // set max amount if current amount exceeds max
      $('#add_barang_amount').attr('data-max', selectedItem.stock);
      if (parseInt($('#add_barang_amount').val()) > selectedItem.stock) {
        $('#add_barang_amount').val(selectedItem.stock);
      }

      // set placeholder
      $('#add_barang_amount').attr('placeholder', 'jumlah (maks : ' + selectedItem.stock + ')')
    });

    $('#add_barang_amount').on('input', function(e) {
      e.stopPropagation();
      // 0,5 7,5
      this.value = this.value.replace('.', ',');
      this.value = this.value.replace(/[^0-9\,]/g, '');

      var amount = parseFloat($(this).val());
      var max = parseFloat($(this).attr('data-max'));
      var min = parseFloat($(this).attr('data-min')) || 0;
      if (amount > max) {
        let max_value = max.toString().replace('.', ',');
        $(this).val(max_value);
      }
      if (amount < min) {
        let min_value = min.toString().replace('.', ',');
        $(this).val(min_value);
      }
    });

    $(document).on('click', '.add_barang_amount_modifier', function() {
      var $input = $('#add_barang_amount');
      var val = $input.val() == '' ? 0 : $input.val();
      var value = parseFloat(val.toString().replaceAll(',', '.'));
      var min = parseFloat($input.attr('data-min')) || 0;
      var max = parseFloat($input.attr('data-max'));
      if ($(this).data('action') === 'plus') {
        if (max && value >= max) {
          return;
        } else {
          value = value + 1 < max ? value + 1 : max;
        }
      } else {
        value = value > min && value - 1 > min ? value - 1 : min;
      }
      value = value.toString().replace('.', ',');
      $input.val(value);
      $input.trigger('change');
    });

    $(document).on('click', '#btn_add_item', function(e) {
      try {
        e.preventDefault();

        var input_amount_value = $('#add_barang_amount').val().toString().replace(',', '.');
        var amount = parseFloat(input_amount_value) || 0;
        if (selectedItem == null) {
          $('#add_barang_item').nextAll('small.text-danger').text('Pilih barang terlebih dahulu');
          return;
        }
        if (amount > selectedItem.stock) {
          $('#add_barang_item').next('small.text-danger').text('Stok barang kosong');
          return;
        }
        if (amount == 0) {
          $('#add_barang_amount').closest('.input-group').next('small.text-danger').text('Jumlah barang tidak boleh kosong');
          return;
        }
        var item = {
          id: selectedItem.id,
          code: selectedItem.code,
          name: selectedItem.name,
          amount: amount,
          unit: selectedItem.unit,
          price: selectedItem.price,
          price_string: selectedItem.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."),
          total: Math.ceil(amount * selectedItem.price),
          total_string: Math.ceil(amount * selectedItem.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."),
        };


        var html = "";
        html += '<div class="row item-row border-bottom py-2" data-code="__code__">';
        html += '    <div class="col-2">';
        html += '        <input type="checkbox" class="mr-2 check-item">';
        html += '        <span class="item-code">__code__</span>';
        html += '        <input type="hidden" name="items[__code__][id]" value="__id__">';
        html += '    </div>';
        html += '    <div class="col-4">';
        html += '        <span class="item-name">__name__ (__unit__)</span>';
        html += '    </div>';
        html += '    <div class="col-1 text-center">';
        html += '        <span class="item-amount">__amount__</span>';
        html += '        <input type="hidden" name="items[__code__][amount]" value="__amount__">';
        html += '    </div>';
        html += '    <div class="col-2 text-right">';
        html += '        <span class="item-price text-monospace">__price_string__</span>';
        html += '    </div>';
        html += '    <div class="col-2 text-right">';
        html += '        <span class="item-total text-monospace">__total_string__</span>';
        html += '    </div>';
        html += '    <div class="col-1 text-center">';
        html += '        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>';
        html += '    </div>';
        html += '</div>';

        $.each(item, function(key, value) {
          html = html.replaceAll('__' + key + '__', value);
        });

        // check if having empty message
        if ($('.item-list').find('.item-row').length == 0) {
          $('.item-list').html('');
        }
        // check if item already exists
        let existingItem = $('.item-list').find('.item-row[data-code="' + item.code + '"]');
        if (existingItem.length > 0) {
          existingItem.remove();
        }
        $('.item-list').append(html);

        $('#add_barang_item').val(null).trigger('change');
        $('#add_barang_amount').val(1);
        $('#add_barang_form').find('small.text-danger').text('');
        amountDisabled(true);
        selectedItem = null;

        document.dispatchEvent(cart_changes);
      } catch (e) {
        console.log(e);
        swal_error(e.message, 'Terjadi kesalahan');
        return false;
      }
    });

    $(document).on('change', '#check_all_items', function() {
      if ($(this).is(':checked')) {
        $('.check-item').prop('checked', true);
      } else {
        $('.check-item').prop('checked', false);
      }
    });

    $(document).on('change', '.check-item', function() {
      if ($('.check-item:checked').length == $('.check-item').length) {
        $('#check_all_items').prop('checked', true);
      } else {
        $('#check_all_items').prop('checked', false);
      }
    });

    $(document).on('click', '.btn-delete-item', function() {
      $(this).closest('.item-row').remove();
      document.dispatchEvent(cart_changes);
    });

    $(document).on('click', '#btn_delete_selected', function() {
      $('.check-item:checked').closest('.item-row').remove();
      document.dispatchEvent(cart_changes);
    });

    // event cart changes handler
    document.addEventListener('cart_changes', function(e) {
      // if empty hide .item-list-footer
      if ($('.item-list').find('.item-row').length == 0) {
        $('.item-list-footer').addClass('invisible');
      } else {
        $('.item-list-footer').removeClass('invisible');
      }
      var subtotal = 0;
      $('.item-list').find('.item-row').each(function() {
        subtotal += parseInt($(this).find('.item-total').text().replaceAll('.', ''));
      });
      $('#cart_subtotal').text(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

      var discount = parseInt($('#cart_input_discount').val()) || 0;
      if (discount > subtotal) {
        discount = subtotal;
        $('#cart_input_discount').val(subtotal);
      }
      var total = subtotal - discount;
      $('#cart_total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      $('#cart_input_total').val(total);

      calculateChangeMoney();
    });

    $(document).on('change', '#cart_check_discount', function() {
      if ($(this).is(':checked')) {
        $('#cart_input_discount').prop('disabled', false);
        $('#cart_input_discount').val('');
      } else {
        $('#cart_input_discount').prop('disabled', true);
        $('#cart_input_discount').val('');
        document.getElementById('cart_input_discount').focus();
      }
      document.dispatchEvent(cart_changes);
    });

    $(document).on('input', '#cart_input_discount', function() {
      this.value = this.value.replace(/[^0-9]/g, '');
      // set pay back to zero
      $('#cart_input_pay').val(0);
      document.dispatchEvent(cart_changes);
    });

    // input only number on #cart_input_pay
    $(document).on('input', '#cart_input_pay', function() {
      this.value = this.value.replace(/[^0-9]/g, '');
      calculateChangeMoney();
    });


    function amountDisabled(bool) {
      $('#add_barang_amount').prop('disabled', bool);
      $('#add_barang_amount').closest('.input-group').find('.add_barang_amount_modifier').prop('disabled', bool);
      $('#btn_add_item').prop('disabled', bool);

    }

    function calculateChangeMoney() {
      var total = parseInt($('#cart_total').text().replaceAll('.', '')) || 0;
      var money = parseInt($('#cart_input_pay').val()) || 0;
      var change = money - total;
      $('#cart_change_money').text(change.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      $('#cart_input_change_money').val(change);
      $('#btn_proceed').prop('disabled', (change < 0))
      if (change < 0) {
        $('#cart_change_money').addClass('text-danger');
      } else {
        $('#cart_change_money').removeClass('text-danger');
      }
    }

    $(document).on('click', '#btn_proceed', function() {
      swal({
        title: "Apakah anda yakin?",
        text: "Anda akan memproses transaksi ini",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $('#form_transaksi').submit();
        }
      });
    });
  </script>
</body>

</html>