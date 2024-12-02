
function show_message(message,status){
    Swal.fire({
        text: message,
        icon: status
    })
}



class LoadBootstrapTable {

    constructor(e) {
        this.url = e.url;
        this.remove_url = e.remove_url;
        this.remove_question = (e.remove_question) ? e.remove_question: e.locale = 'Bạn có muốn xóa item này không';
        this.detete_button = (e.detete_button) ? e.detete_button: "#delete-item";
        this.table = (e.table) ? e.table : '.bootstrap-table';
        this.field_id = (e.field_id) ? e.field_id : 'id';
        this.form_search = (e.form_search) ? e.form_search : "#form-search";
        this.sort_name = (e.sort_name) ? e.sort_name : 'id';
        this.sort_order = (e.sort_order) ? e.sort_order : 'desc';
        this.page_size = (e.page_size) ? e.page_size: 20;
        this.search = (e.search) ? e.search : false;
        this.method = (e.method) ? e.method : 'get';
        this.locale = 'vi-VN';
        this.delete_method = (e.delete_method)? e.delete_method : 'post';
        this.btn_action_table = '.btn_action_table';
        this.init();
    }

    init() {
        let btn_delete = $(this.detete_button);
        btn_delete.prop('disabled', true);
        let table = $(this.table);
        let form_search = this.form_search;
        let remove_url = this.remove_url;
        let remove_question = this.remove_question;
        let data_url = this.url;
        let field_id = this.field_id;
        let method = this.method;
        let locale = this.locale;
        let delete_method = this.delete_method;
        let btn_action = $(this.btn_action_table);
        btn_action.toggle(false);

        table.bootstrapTable({
            url: data_url,
            idField: field_id,
            method: method,
            locale: locale,
            sidePagination: 'server',
            pagination: true,
            sortName: this.sort_name,
            sortOrder: this.sort_order,
            toggle: 'table',
            search: this.search,
            pageSize: this.page_size,

            queryParams: function (params) {
                let field_search = $(form_search).serializeArray();
                $.each(field_search, function (i, item) {
                    if (params[item.name]) {
                        params[item.name] += ';' + item.value;
                    }
                    else {
                        params[item.name] = item.value;
                    }

                });
                return params;
            }
        });

        $(this.form_search).on('submit', function (event) {
            if (event.isDefaultPrevented()) {
                return false;
            }
            let tableActive = $(this).attr('data-search');
            table = tableActive?$(tableActive):table;
            event.preventDefault();
            table.bootstrapTable('refresh',{pageNumber: 1});
            // $('#modalFilter').modal('hide');
            return false;
        });

        table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table', () => {
            btn_delete.prop('disabled', !table.bootstrapTable('getSelections').length);
            btn_action.toggle(table.bootstrapTable('getSelections').length > 0);
        });

        btn_delete.on('click', function () {
            let ids = $("input[name=btSelectItem]:checked").map(function(){return $(this).val();}).get();
            Swal.fire({
                title: '',
                text: remove_question,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText:'Đồng ý',
                cancelButtonText: 'Hủy',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: delete_method,
                        url: remove_url,
                        dataType: 'json',
                        data: {
                            'ids': ids
                        },
                        success: function (result) {
                            show_message(result.message, result.status);
                            table.bootstrapTable('refresh');
                            btn_delete.attr('disabled',true);
                            btn_action.toggle(false);
                            return false;
                        }
                    });
                }
            });

            return false;
        });

        table.on('click', '.remove-item', function () {
            let ids = [$(this).data('id')];
            if (!confirm(remove_question)) {
                return false;
            }

            $.ajax({
                type: delete_method,
                url: remove_url,
                dataType: 'json',
                data: {
                    'ids': ids
                },
                success: function (result) {
                    show_message(result.message, result.status);

                    table.bootstrapTable('refresh');
                    return false;

                }
            });

            return false;
        });
    }

    refresh(options = {}) {
        if (options) {
            $(this.table).bootstrapTable('refreshOptions', options);
        }
        else {
            $(this.table).bootstrapTable('refresh', options);
        }
    }
    
}

$(document).ready(function(){
    // $('.select2').select2({
    //     allowClear: true,
    //     dropdownAutoWidth : true,
    //     width: '100%',
    //     placeholder: function(params) {
    //         return {
    //             id: null,
    //             text: params.placeholder,
    //         }
    //     },
    // });
    $("body").on('input', '.integerInput', function () {
        $(this).val($(this).val().replace(/[^0-9]/gi, ''));
    });
    $("body").on('input', '.decimalInput', function (evt) {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });

    $("body").on('keypress', '.is-number', function () {
        return validate_isNumberKey(this);
    });

    $("body").on('keyup', '.number-format', function () {
        return validate_FormatNumber(this);
    });

    function validate_isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode == 59 || charCode == 46)
            return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function validate_FormatNumber(a) {
        a.value = a.value.replace(/\./gi, "");
        a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }
})

function formatCash(str) {
    str = str.toString().replace(/\./g, "");
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + ',')) + prev
    })
}

function toVND (value) {
    // value = value.toString().replace(/\./g, "");
    const formatted = new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
      })
      .format(value)
      .replace("₫", "")
      .trim();
    
    return formatted;
}





