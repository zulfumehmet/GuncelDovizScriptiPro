$(document).ready(function() {

    (function($) {
        "use strict";


        jQuery.validator.addMethod('answercheck', function(value, element) {
            return this.optional(element) || /^\bcat\b$/.test(value)
        }, "type the correct answer -_-");

        // validate contactForm form
        $(function() {
            $('#contactForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    subject: {
                        required: true,
                        minlength: 4
                    },
                    number: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 20
                    }
                },
                messages: {
                    name: {
                        required: "Adınızı boş bırakamazsınız?",
                        minlength: "Adınız 2 karakterden küçük olamaz"
                    },
                    subject: {
                        required: "Konuyu boş bırakamazsınız",
                        minlength: "Konu enaz 4 karakterden oluşmalıdır"
                    },
                    number: {
                        required: "Lütfen numaranızı giriniz",
                        minlength: "en az 5 karakter girmelisiniz"
                    },
                    email: {
                        required: "mail adresinizi giriniz"
                    },
                    message: {
                        required: "Mesaj kısmını boş bırakamzsınız",
                        minlength: "En az 20 karakter yazmalısınız"
                    }
                },
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "contact_process.php",
                        success: function() {
                            $('#contactForm :input').attr('disabled', 'disabled');
                            $('#contactForm').fadeTo("slow", 1, function() {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor', 'default');
                                $('#success').fadeIn()
                                $('.modal').modal('hide');
                                $('#success').modal('show');
                            })
                        },
                        error: function() {
                            $('#contactForm').fadeTo("slow", 1, function() {
                                $('#error').fadeIn()
                                $('.modal').modal('hide');
                                $('#error').modal('show');
                            })
                        }
                    })
                }
            })
        })

    })(jQuery)
})