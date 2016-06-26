/**
 * Created by kalebclark on 6/25/16.
 */
$(function() {

    $('[data-toggle="tabs"]').click(function(e) {
        console.log('foobar');
        var $this = $(this);

        $this.tab('show');
    });

    var details = new Vue({
        el: '#details',
        data: {
            cw: []
        }
    });

    var headers = new Vue({
        el: '#headers',
        data: {
            cw: []
        }
    });

    var formData = new Vue({
        el: '#form-data',
        data: {
            cw: []
        }
    });

    var logs = new Vue({
        el: '#logs',
        data: {
            cw: []
        }
    });

    $(".selectable").click(function(e) {
        var id = $(this).attr('data');
        var allData;
        $('#details-row').removeClass('hide');

        $.ajax({
            url: "http://mac.laradev/__clockwork/"+id,
            success: function(result) {
                //this.$remove("cw");
                //this.$set("cw", result)
                details.cw = result;
                headers.cw = result;
                formData.cw = result;
                logs.cw = result;
                console.log(details);
            }
        });



    });
});