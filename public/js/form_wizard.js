(function () {
    $('#next_step1').on('click',function ()
    {
        $("form[name='step1']").submit();
    });

    $('#prev_step2').on('click',function ()
    {
        prev_2();
    });

    $('#next_step2').on('click',function ()
    {
        $("form[name='step2']").submit();
    });

    $('#prev_step3').on('click',function ()
    {
        prev_3();
    });

    function step_1() {
        $('#form_1').show();
        $('#form_2').hide();
        $('#form_3').hide();
    }

    function step_2()
    {
        $('#form_1').hide();
        $('#form_2').show();
        $('#form_3').hide();
    }

    function step_3()
    {
        $('#form_1').hide();
        $('#form_2').hide();
        $('#form_3').show();
    }

    function prev_2()
    {
        $('#form_1').show();
        $('#form_2').hide();
        $('#form_3').hide();
    }

    function prev_3()
    {
        $('#form_1').hide();
        $('#form_2').show();
        $('#form_3').hide();
    }

    $("form[name='step1']").validate({

        invalidHandler: function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
                step_1();
            }
        },

        rules: {
            title: "required",
        },
        messages: {
            title: "Please enter your title",
        },

        submitHandler: function(form) {
            step_2();
        }
    });

    $("form[name='step2']").validate({

        invalidHandler: function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
                step_2();
            }
        },

        rules: {
            category: "required",
        },
        messages: {
            category: "Please choose your category",
        },

        submitHandler: function(form) {
            step_3();
        }
    });

})();