$(document).ready(function() {
    if ($('.data-table-list').length > 0) {
        $('.data-table-list').DataTable({
            // "columnDefs": [
            //     {
            //       "targets": [ 4 ],
            //       "orderable": false,
            //     }]
        });
    }
});