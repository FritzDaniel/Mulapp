/*!
 * jQuery Validation Plugin v1.19.0
 *
 * https://jqueryvalidation.org/
 *
 * Copyright (c) 2018 Jörn Zaefferer
 * Released under the MIT license
 */
(function( factory ) {
    if ( typeof define === "function" && define.amd ) {
        define( ["jquery", "./jquery.validate"], factory );
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory( require( "jquery" ) );
    } else {
        factory( jQuery );
    }
}(function( $ ) {

    ( function() {

        function stripHtml( value ) {

            // Remove html tags and space chars
            return value.replace( /<.[^<>]*?>/g, " " ).replace( /&nbsp;|&#160;/gi, " " )

            // Remove punctuation
                .replace( /[.(),;:!?%#$'\"_+=\/\-“”’]*/g, "" );
        }

        $.validator.addMethod( "maxWords", function( value, element, params ) {
            return this.optional( element ) || stripHtml( value ).match( /\b\w+\b/g ).length <= params;
        }, $.validator.format( "Please enter {0} words or less." ) );

        $.validator.addMethod( "minWords", function( value, element, params ) {
            return this.optional( element ) || stripHtml( value ).match( /\b\w+\b/g ).length >= params;
        }, $.validator.format( "Please enter at least {0} words." ) );

        $.validator.addMethod( "rangeWords", function( value, element, params ) {
            var valueStripped = stripHtml( value ),
                regex = /\b\w+\b/g;
            return this.optional( element ) || valueStripped.match( regex ).length >= params[ 0 ] && valueStripped.match( regex ).length <= params[ 1 ];
        }, $.validator.format( "Please enter between {0} and {1} words." ) );

    }() );

    /**
     * This is used in the United States to process payments, deposits,
     * or transfers using the Automated Clearing House (ACH) or Fedwire
     * systems. A very common use case would be to validate a form for
     * an ACH bill payment.
     */
    $.validator.addMethod( "abaRoutingNumber", function( value ) {
        var checksum = 0;
        var tokens = value.split( "" );
        var length = tokens.length;

        // Length Check
        if ( length !== 9 ) {
            return false;
        }

        // Calc the checksum
        // https://en.wikipedia.org/wiki/ABA_routing_transit_number
        for ( var i = 0; i < length; i += 3 ) {
            checksum +=	parseInt( tokens[ i ], 10 )     * 3 +
                parseInt( tokens[ i + 1 ], 10 ) * 7 +
                parseInt( tokens[ i + 2 ], 10 );
        }

        // If not zero and divisible by 10 then valid
        if ( checksum !== 0 && checksum % 10 === 0 ) {
            return true;
        }

        return false;
    }, "Please enter a valid routing number." );

// Accept a value from a file input based on a required mimetype
    $.validator.addMethod( "accept", function( value, element, param ) {

        // Split mime on commas in case we have multiple types we can accept
        var typeParam = typeof param === "string" ? param.replace( /\s/g, "" ) : "image/*",
            optionalValue = this.optional( element ),
            i, file, regex;

        // Element is optional
        if ( optionalValue ) {
            return optionalValue;
        }

        if ( $( element ).attr( "type" ) === "file" ) {

            // Escape string to be used in the regex
            // see: https://stackoverflow.com/questions/3446170/escape-string-for-use-in-javascript-regex
            // Escape also "/*" as "/.*" as a wildcard
            typeParam = typeParam
                .replace( /[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&" )
                .replace( /,/g, "|" )
                .replace( /\/\*/g, "/.*" );

            // Check if the element has a FileList before checking each file
            if ( element.files && element.files.length ) {
                regex = new RegExp( ".?(" + typeParam + ")$", "i" );
                for ( i = 0; i < element.files.length; i++ ) {
                    file = element.files[ i ];

                    // Grab the mimetype from the loaded file, verify it matches
                    if ( !file.type.match( regex ) ) {
                        return false;
                    }
                }
            }
        }

        // Either return true because we've validated each file, or because the
        // browser does not support element.files and the FileList feature
        return true;
    }, $.validator.format( "Please enter a value with a valid mimetype." ) );

    $.validator.addMethod( "alphanumeric", function( value, element ) {
        return this.optional( element ) || /^\w+$/i.test( value );
    }, "Letters, numbers, and underscores only please" );

    /*
     * Dutch bank account numbers (not 'giro' numbers) have 9 digits
     * and pass the '11 check'.
     * We accept the notation with spaces, as that is common.
     * acceptable: 123456789 or 12 34 56 789
     */
    $.validator.addMethod( "bankaccountNL", function( value, element ) {
        if ( this.optional( element ) ) {
            return true;
        }
        if ( !( /^[0-9]{9}|([0-9]{2} ){3}[0-9]{3}$/.test( value ) ) ) {
            return false;
        }

        // Now '11 check'
        var account = value.replace( / /g, "" ), // Remove spaces
            sum = 0,
            len = account.length,
            pos, factor, digit;
        for ( pos = 0; pos < len; pos++ ) {
            factor = len - pos;
            digit = account.substring( pos, pos + 1 );
            sum = sum + factor * digit;
        }
        return sum % 11 === 0;
    }, "Please specify a valid bank account number" );

    $.validator.addMethod( "bankorgiroaccountNL", function( value, element ) {
        return this.optional( element ) ||
            ( $.validator.methods.bankaccountNL.call( this, value, element ) ) ||
            ( $.validator.methods.giroaccountNL.call( this, value, element ) );
    }, "Please specify a valid bank or giro account number" );

    /**
     * BIC is the business identifier code (ISO 9362). This BIC check is not a guarantee for authenticity.
     *
     * BIC pattern: BBBBCCLLbbb (8 or 11 characters long; bbb is optional)
     *
     * Validation is case-insensitive. Please make sure to normalize input yourself.
     *
     * BIC definition in detail:
     * - First 4 characters - bank code (only letters)
     * - Next 2 characters - ISO 3166-1 alpha-2 country code (only letters)
     * - Next 2 characters - location code (letters and digits)
     *   a. shall not start with '0' or '1'
     *   b. second character must be a letter ('O' is not allowed) or digit ('0' for test (therefore not allowed), '1' denoting passive participant, '2' typically reverse-billing)
     * - Last 3 characters - branch code, optional (shall not start with 'X' except in case of 'XXX' for primary office) (letters and digits)
     */
    $.validator.addMethod( "bic", function( value, element ) {
        return this.optional( element ) || /^([A-Z]{6}[A-Z2-9][A-NP-Z1-9])(X{3}|[A-WY-Z0-9][A-Z0-9]{2})?$/.test( value.toUpperCase() );
    }, "Please specify a valid BIC code" );

    /*
     * Código de identificación fiscal ( CIF ) is the tax identification code for Spanish legal entities
     * Further rules can be found in Spanish on http://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal
     *
     * Spanish CIF structure:
     *
     * [ T ][ P ][ P ][ N ][ N ][ N ][ N ][ N ][ C ]
     *
     * Where:
     *
     * T: 1 character. Kind of Organization Letter: [ABCDEFGHJKLMNPQRSUVW]
     * P: 2 characters. Province.
     * N: 5 characters. Secuencial Number within the province.
     * C: 1 character. Control Digit: [0-9A-J].
     *
     * [ T ]: Kind of Organizations. Possible values:
     *
     *   A. Corporations
     *   B. LLCs
     *   C. General partnerships
     *   D. Companies limited partnerships
     *   E. Communities of goods
     *   F. Cooperative Societies
     *   G. Associations
     *   H. Communities of homeowners in horizontal property regime
     *   J. Civil Societies
     *   K. Old format
     *   L. Old format
     *   M. Old format
     *   N. Nonresident entities
     *   P. Local authorities
     *   Q. Autonomous bodies, state or not, and the like, and congregations and religious institutions
     *   R. Congregations and religious institutions (since 2008 ORDER EHA/451/2008)
     *   S. Organs of State Administration and regions
     *   V. Agrarian Transformation
     *   W. Permanent establishments of non-resident in Spain
     *
     * [ C ]: Control Digit. It can be a number or a letter depending on T value:
     * [ T ]  -->  [ C ]
     * ------    ----------
     *   A         Number
     *   B         Number
     *   E         Number
     *   H         Number
     *   K         Letter
     *   P         Letter
     *   Q         Letter
     *   S         Letter
     *
     */
    $.validator.addMethod( "cifES", function( value, element ) {
        "use strict";

        if ( this.optional( element ) ) {
            return true;
        }

        var cifRegEx = new RegExp( /^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/gi );
        var letter  = value.substring( 0, 1 ), // [ T ]
            number  = value.substring( 1, 8 ), // [ P ][ P ][ N ][ N ][ N ][ N ][ N ]
            control = value.substring( 8, 9 ), // [ C ]
            all_sum = 0,
            even_sum = 0,
            odd_sum = 0,
            i, n,
            control_digit,
            control_letter;

        function isOdd( n ) {
            return n % 2 === 0;
        }

        // Quick format test
        if ( value.length !== 9 || !cifRegEx.test( value ) ) {
            return false;
        }

        for ( i = 0; i < number.length; i++ ) {
            n = parseInt( number[ i ], 10 );

            // Odd positions
            if ( isOdd( i ) ) {

                // Odd positions are multiplied first.
                n *= 2;

                // If the multiplication is bigger than 10 we need to adjust
                odd_sum += n < 10 ? n : n - 9;

                // Even positions
                // Just sum them
            } else {
                even_sum += n;
            }
        }

        all_sum = even_sum + odd_sum;
        control_digit = ( 10 - ( all_sum ).toString().substr( -1 ) ).toString();
        control_digit = parseInt( control_digit, 10 ) > 9 ? "0" : control_digit;
        control_letter = "JABCDEFGHI".substr( control_digit, 1 ).toString();

        // Control must be a digit
        if ( letter.match( /[ABEH]/ ) ) {
            return control === control_digit;

            // Control must be a letter
        } else if ( letter.match( /[KPQS]/ ) ) {
            return control === control_letter;
        }

        // Can be either
        return control === control_digit || control === control_letter;

    }, "Please specify a valid CIF number." );

    /*
     * Brazillian CNH number (Carteira Nacional de Habilitacao) is the License Driver number.
     * CNH numbers have 11 digits in total: 9 numbers followed by 2 check numbers that are being used for validation.
     */
    $.validator.addMethod( "cnhBR", function( value ) {

        // Removing special characters from value
        value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "" );

        // Checking value to have 11 digits only
        if ( value.length !== 11 ) {
            return false;
        }

        var sum = 0, dsc = 0, firstChar,
            firstCN, secondCN, i, j, v;

        firstChar = value.charAt( 0 );

        if ( new Array( 12 ).join( firstChar ) === value ) {
            return false;
        }

        // Step 1 - using first Check Number:
        for ( i = 0, j = 9, v = 0; i < 9; ++i, --j ) {
            sum += +( value.charAt( i ) * j );
        }

        firstCN = sum % 11;
        if ( firstCN >= 10 ) {
            firstCN = 0;
            dsc = 2;
        }

        sum = 0;
        for ( i = 0, j = 1, v = 0; i < 9; ++i, ++j ) {
            sum += +( value.charAt( i ) * j );
        }

        secondCN = sum % 11;
        if ( secondCN >= 10 ) {
            secondCN = 0;
        } else {
            secondCN = secondCN - dsc;
        }

        return ( String( firstCN ).concat( secondCN ) === value.substr( -2 ) );

    }, "Please specify a valid CNH number" );

    /*
     * Brazillian value number (Cadastrado de Pessoas Juridica).
     * value numbers have 14 digits in total: 12 numbers followed by 2 check numbers that are being used for validation.
     */
    $.validator.addMethod( "cnpjBR", function( value, element ) {
        "use strict";

        if ( this.optional( element ) ) {
            return true;
        }

        // Removing no number
        value = value.replace( /[^\d]+/g, "" );

        // Checking value to have 14 digits only
        if ( value.length !== 14 ) {
            return false;
        }

        // Elimina values invalidos conhecidos
        if ( value === "00000000000000" ||
            value === "11111111111111" ||
            value === "22222222222222" ||
            value === "33333333333333" ||
            value === "44444444444444" ||
            value === "55555555555555" ||
            value === "66666666666666" ||
            value === "77777777777777" ||
            value === "88888888888888" ||
            value === "99999999999999" ) {
            return false;
        }

        // Valida DVs
        var tamanho = ( value.length - 2 );
        var numeros = value.substring( 0, tamanho );
        var digitos = value.substring( tamanho );
        var soma = 0;
        var pos = tamanho - 7;

        for ( var i = tamanho; i >= 1; i-- ) {
            soma += numeros.charAt( tamanho - i ) * pos--;
            if ( pos < 2 ) {
                pos = 9;
            }
        }

        var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if ( resultado !== parseInt( digitos.charAt( 0 ), 10 ) ) {
            return false;
        }

        tamanho = tamanho + 1;
        numeros = value.substring( 0, tamanho );
        soma = 0;
        pos = tamanho - 7;

        for ( var il = tamanho; il >= 1; il-- ) {
            soma += numeros.charAt( tamanho - il ) * pos--;
            if ( pos < 2 ) {
                pos = 9;
            }
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if ( resultado !== parseInt( digitos.charAt( 1 ), 10 ) ) {
            return false;
        }

        return true;

    }, "Please specify a CNPJ value number" );

    /*
     * Brazillian CPF number (Cadastrado de Pessoas Físicas) is the equivalent of a Brazilian tax registration number.
     * CPF numbers have 11 digits in total: 9 numbers followed by 2 check numbers that are being used for validation.
     */
    $.validator.addMethod( "cpfBR", function( value, element ) {
        "use strict";

        if ( this.optional( element ) ) {
            return true;
        }

        // Removing special characters from value
        value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "" );

        // Checking value to have 11 digits only
        if ( value.length !== 11 ) {
            return false;
        }

        var sum = 0,
            firstCN, secondCN, checkResult, i;

        firstCN = parseInt( value.substring( 9, 10 ), 10 );
        secondCN = parseInt( value.substring( 10, 11 ), 10 );

        checkResult = function( sum, cn ) {
            var result = ( sum * 10 ) % 11;
            if ( ( result === 10 ) || ( result === 11 ) ) {
                result = 0;
            }
            return ( result === cn );
        };

        // Checking for dump data
        if ( value === "" ||
            value === "00000000000" ||
            value === "11111111111" ||
            value === "22222222222" ||
            value === "33333333333" ||
            value === "44444444444" ||
            value === "55555555555" ||
            value === "66666666666" ||
            value === "77777777777" ||
            value === "88888888888" ||
            value === "99999999999"
        ) {
            return false;
        }

        // Step 1 - using first Check Number:
        for ( i = 1; i <= 9; i++ ) {
            sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 11 - i );
        }

        // If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
        if ( checkResult( sum, firstCN ) ) {
            sum = 0;
            for ( i = 1; i <= 10; i++ ) {
                sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 12 - i );
            }
            return checkResult( sum, secondCN );
        }
        return false;

    }, "Please specify a valid CPF number" );

// https://jqueryvalidation.org/creditcard-method/
// based on https://en.wikipedia.org/wiki/Luhn_algorithm
    $.validator.addMethod( "creditcard", function( value, element ) {
        if ( this.optional( element ) ) {
            return "dependency-mismatch";
        }

        // Accept only spaces, digits and dashes
        if ( /[^0-9 \-]+/.test( value ) ) {
            return false;
        }

        var nCheck = 0,
            nDigit = 0,
            bEven = false,
            n, cDigit;

        value = value.replace( /\D/g, "" );

        // Basing min and max length on
        // https://dev.ean.com/general-info/valid-card-types/
        if ( value.length < 13 || value.length > 19 ) {
            return false;
        }

        for ( n = value.length - 1; n >= 0; n-- ) {
            cDigit = value.charAt( n );
            nDigit = parseInt( cDigit, 10 );
            if ( bEven ) {
                if ( ( nDigit *= 2 ) > 9 ) {
                    nDigit -= 9;
                }
            }

            nCheck += nDigit;
            bEven = !bEven;
        }

        return ( nCheck % 10 ) === 0;
    }, "Please enter a valid credit card number." );

    /* NOTICE: Modified version of Castle.Components.Validator.CreditCardValidator
     * Redistributed under the Apache License 2.0 at http://www.apache.org/licenses/LICENSE-2.0
     * Valid Types: mastercard, visa, amex, dinersclub, enroute, discover, jcb, unknown, all (overrides all other settings)
     */
    $.validator.addMethod( "creditcardtypes", function( value, element, param ) {
        if ( /[^0-9\-]+/.test( value ) ) {
            return false;
        }

        value = value.replace( /\D/g, "" );

        var validTypes = 0x0000;

        if ( param.mastercard ) {
            validTypes |= 0x0001;
        }
        if ( param.visa ) {
            validTypes |= 0x0002;
        }
        if ( param.amex ) {
            validTypes |= 0x0004;
        }
        if ( param.dinersclub ) {
            validTypes |= 0x0008;
        }
        if ( param.enroute ) {
            validTypes |= 0x0010;
        }
        if ( param.discover ) {
            validTypes |= 0x0020;
        }
        if ( param.jcb ) {
            validTypes |= 0x0040;
        }
        if ( param.unknown ) {
            validTypes |= 0x0080;
        }
        if ( param.all ) {
            validTypes = 0x0001 | 0x0002 | 0x0004 | 0x0008 | 0x0010 | 0x0020 | 0x0040 | 0x0080;
        }
        if ( validTypes & 0x0001 && ( /^(5[12345])/.test( value ) || /^(2[234567])/.test( value ) ) ) { // Mastercard
            return value.length === 16;
        }
        if ( validTypes & 0x0002 && /^(4)/.test( value ) ) { // Visa
            return value.length === 16;
        }
        if ( validTypes & 0x0004 && /^(3[47])/.test( value ) ) { // Amex
            return value.length === 15;
        }
        if ( validTypes & 0x0008 && /^(3(0[012345]|[68]))/.test( value ) ) { // Dinersclub
            return value.length === 14;
        }
        if ( validTypes & 0x0010 && /^(2(014|149))/.test( value ) ) { // Enroute
            return value.length === 15;
        }
        if ( validTypes & 0x0020 && /^(6011)/.test( value ) ) { // Discover
            return value.length === 16;
        }
        if ( validTypes & 0x0040 && /^(3)/.test( value ) ) { // Jcb
            return value.length === 16;
        }
        if ( validTypes & 0x0040 && /^(2131|1800)/.test( value ) ) { // Jcb
            return value.length === 15;
        }
        if ( validTypes & 0x0080 ) { // Unknown
            return true;
        }
        return false;
    }, "Please enter a valid credit card number." );

    /**
     * Validates currencies with any given symbols by @jameslouiz
     * Symbols can be optional or required. Symbols required by default
     *
     * Usage examples:
     *  currency: ["£", false] - Use false for soft currency validation
     *  currency: ["$", false]
     *  currency: ["RM", false] - also works with text based symbols such as "RM" - Malaysia Ringgit etc
     *
     *  <input class="currencyInput" name="currencyInput">
     *
     * Soft symbol checking
     *  currencyInput: {
     *     currency: ["$", false]
     *  }
     *
     * Strict symbol checking (default)
     *  currencyInput: {
     *     currency: "$"
     *     //OR
     *     currency: ["$", true]
     *  }
     *
     * Multiple Symbols
     *  currencyInput: {
     *     currency: "$,£,¢"
     *  }
     */
    $.validator.addMethod( "currency", function( value, element, param ) {
        var isParamString = typeof param === "string",
            symbol = isParamString ? param : param[ 0 ],
            soft = isParamString ? true : param[ 1 ],
            regex;

        symbol = symbol.replace( /,/g, "" );
        symbol = soft ? symbol + "]" : symbol + "]?";
        regex = "^[" + symbol + "([1-9]{1}[0-9]{0,2}(\\,[0-9]{3})*(\\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\\.[0-9]{0,2})?|0(\\.[0-9]{0,2})?|(\\.[0-9]{1,2})?)$";
        regex = new RegExp( regex );
        return this.optional( element ) || regex.test( value );

    }, "Please specify a valid currency" );

    $.validator.addMethod( "dateFA", function( value, element ) {
        return this.optional( element ) || /^[1-4]\d{3}\/((0?[1-6]\/((3[0-1])|([1-2][0-9])|(0?[1-9])))|((1[0-2]|(0?[7-9]))\/(30|([1-2][0-9])|(0?[1-9]))))$/.test( value );
    }, $.validator.messages.date );

    /**
     * Return true, if the value is a valid date, also making this formal check dd/mm/yyyy.
     *
     * @example $.validator.methods.date("01/01/1900")
     * @result true
     *
     * @example $.validator.methods.date("01/13/1990")
     * @result false
     *
     * @example $.validator.methods.date("01.01.1900")
     * @result false
     *
     * @example <input name="pippo" class="{dateITA:true}" />
     * @desc Declares an optional input element whose value must be a valid date.
     *
     * @name $.validator.methods.dateITA
     * @type Boolean
     * @cat Plugins/Validate/Methods
     */
    $.validator.addMethod( "dateITA", function( value, element ) {
        var check = false,
            re = /^\d{1,2}\/\d{1,2}\/\d{4}$/,
            adata, gg, mm, aaaa, xdata;
        if ( re.test( value ) ) {
            adata = value.split( "/" );
            gg = parseInt( adata[ 0 ], 10 );
            mm = parseInt( adata[ 1 ], 10 );
            aaaa = parseInt( adata[ 2 ], 10 );
            xdata = new Date( Date.UTC( aaaa, mm - 1, gg, 12, 0, 0, 0 ) );
            if ( ( xdata.getUTCFullYear() === aaaa ) && ( xdata.getUTCMonth() === mm - 1 ) && ( xdata.getUTCDate() === gg ) ) {
                check = true;
            } else {
                check = false;
            }
        } else {
            check = false;
        }
        return this.optional( element ) || check;
    }, $.validator.messages.date );

    $.validator.addMethod( "dateNL", function( value, element ) {
        return this.optional( element ) || /^(0?[1-9]|[12]\d|3[01])[\.\/\-](0?[1-9]|1[012])[\.\/\-]([12]\d)?(\d\d)$/.test( value );
    }, $.validator.messages.date );

// Older "accept" file extension method. Old docs: http://docs.jquery.com/Plugins/Validation/Methods/accept
    $.validator.addMethod( "extension", function( value, element, param ) {
        param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
        return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    }, $.validator.format( "Please enter a value with a valid extension." ) );

    /**
     * Dutch giro account numbers (not bank numbers) have max 7 digits
     */
    $.validator.addMethod( "giroaccountNL", function( value, element ) {
        return this.optional( element ) || /^[0-9]{1,7}$/.test( value );
    }, "Please specify a valid giro account number" );

    $.validator.addMethod( "greaterThan", function( value, element, param ) {
        var target = $( param );

        if ( this.settings.onfocusout && target.not( ".validate-greaterThan-blur" ).length ) {
            target.addClass( "validate-greaterThan-blur" ).on( "blur.validate-greaterThan", function() {
                $( element ).valid();
            } );
        }

        return value > target.val();
    }, "Please enter a greater value." );

    $.validator.addMethod( "greaterThanEqual", function( value, element, param ) {
        var target = $( param );

        if ( this.settings.onfocusout && target.not( ".validate-greaterThanEqual-blur" ).length ) {
            target.addClass( "validate-greaterThanEqual-blur" ).on( "blur.validate-greaterThanEqual", function() {
                $( element ).valid();
            } );
        }

        return value >= target.val();
    }, "Please enter a greater value." );

    /**
     * IBAN is the international bank account number.
     * It has a country - specific format, that is checked here too
     *
     * Validation is case-insensitive. Please make sure to normalize input yourself.
     */
    $.validator.addMethod( "iban", function( value, element ) {

        // Some quick simple tests to prevent needless work
        if ( this.optional( element ) ) {
            return true;
        }

        // Remove spaces and to upper case
        var iban = value.replace( / /g, "" ).toUpperCase(),
            ibancheckdigits = "",
            leadingZeroes = true,
            cRest = "",
            cOperator = "",
            countrycode, ibancheck, charAt, cChar, bbanpattern, bbancountrypatterns, ibanregexp, i, p;

        // Check for IBAN code length.
        // It contains:
        // country code ISO 3166-1 - two letters,
        // two check digits,
        // Basic Bank Account Number (BBAN) - up to 30 chars
        var minimalIBANlength = 5;
        if ( iban.length < minimalIBANlength ) {
            return false;
        }

        // Check the country code and find the country specific format
        countrycode = iban.substring( 0, 2 );
        bbancountrypatterns = {
            "AL": "\\d{8}[\\dA-Z]{16}",
            "AD": "\\d{8}[\\dA-Z]{12}",
            "AT": "\\d{16}",
            "AZ": "[\\dA-Z]{4}\\d{20}",
            "BE": "\\d{12}",
            "BH": "[A-Z]{4}[\\dA-Z]{14}",
            "BA": "\\d{16}",
            "BR": "\\d{23}[A-Z][\\dA-Z]",
            "BG": "[A-Z]{4}\\d{6}[\\dA-Z]{8}",
            "CR": "\\d{17}",
            "HR": "\\d{17}",
            "CY": "\\d{8}[\\dA-Z]{16}",
            "CZ": "\\d{20}",
            "DK": "\\d{14}",
            "DO": "[A-Z]{4}\\d{20}",
            "EE": "\\d{16}",
            "FO": "\\d{14}",
            "FI": "\\d{14}",
            "FR": "\\d{10}[\\dA-Z]{11}\\d{2}",
            "GE": "[\\dA-Z]{2}\\d{16}",
            "DE": "\\d{18}",
            "GI": "[A-Z]{4}[\\dA-Z]{15}",
            "GR": "\\d{7}[\\dA-Z]{16}",
            "GL": "\\d{14}",
            "GT": "[\\dA-Z]{4}[\\dA-Z]{20}",
            "HU": "\\d{24}",
            "IS": "\\d{22}",
            "IE": "[\\dA-Z]{4}\\d{14}",
            "IL": "\\d{19}",
            "IT": "[A-Z]\\d{10}[\\dA-Z]{12}",
            "KZ": "\\d{3}[\\dA-Z]{13}",
            "KW": "[A-Z]{4}[\\dA-Z]{22}",
            "LV": "[A-Z]{4}[\\dA-Z]{13}",
            "LB": "\\d{4}[\\dA-Z]{20}",
            "LI": "\\d{5}[\\dA-Z]{12}",
            "LT": "\\d{16}",
            "LU": "\\d{3}[\\dA-Z]{13}",
            "MK": "\\d{3}[\\dA-Z]{10}\\d{2}",
            "MT": "[A-Z]{4}\\d{5}[\\dA-Z]{18}",
            "MR": "\\d{23}",
            "MU": "[A-Z]{4}\\d{19}[A-Z]{3}",
            "MC": "\\d{10}[\\dA-Z]{11}\\d{2}",
            "MD": "[\\dA-Z]{2}\\d{18}",
            "ME": "\\d{18}",
            "NL": "[A-Z]{4}\\d{10}",
            "NO": "\\d{11}",
            "PK": "[\\dA-Z]{4}\\d{16}",
            "PS": "[\\dA-Z]{4}\\d{21}",
            "PL": "\\d{24}",
            "PT": "\\d{21}",
            "RO": "[A-Z]{4}[\\dA-Z]{16}",
            "SM": "[A-Z]\\d{10}[\\dA-Z]{12}",
            "SA": "\\d{2}[\\dA-Z]{18}",
            "RS": "\\d{18}",
            "SK": "\\d{20}",
            "SI": "\\d{15}",
            "ES": "\\d{20}",
            "SE": "\\d{20}",
            "CH": "\\d{5}[\\dA-Z]{12}",
            "TN": "\\d{20}",
            "TR": "\\d{5}[\\dA-Z]{17}",
            "AE": "\\d{3}\\d{16}",
            "GB": "[A-Z]{4}\\d{14}",
            "VG": "[\\dA-Z]{4}\\d{16}"
        };

        bbanpattern = bbancountrypatterns[ countrycode ];

        // As new countries will start using IBAN in the
        // future, we only check if the countrycode is known.
        // This prevents false negatives, while almost all
        // false positives introduced by this, will be caught
        // by the checksum validation below anyway.
        // Strict checking should return FALSE for unknown
        // countries.
        if ( typeof bbanpattern !== "undefined" ) {
            ibanregexp = new RegExp( "^[A-Z]{2}\\d{2}" + bbanpattern + "$", "" );
            if ( !( ibanregexp.test( iban ) ) ) {
                return false; // Invalid country specific format
            }
        }

        // Now check the checksum, first convert to digits
        ibancheck = iban.substring( 4, iban.length ) + iban.substring( 0, 4 );
        for ( i = 0; i < ibancheck.length; i++ ) {
            charAt = ibancheck.charAt( i );
            if ( charAt !== "0" ) {
                leadingZeroes = false;
            }
            if ( !leadingZeroes ) {
                ibancheckdigits += "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf( charAt );
            }
        }

        // Calculate the result of: ibancheckdigits % 97
        for ( p = 0; p < ibancheckdigits.length; p++ ) {
            cChar = ibancheckdigits.charAt( p );
            cOperator = "" + cRest + "" + cChar;
            cRest = cOperator % 97;
        }
        return cRest === 1;
    }, "Please specify a valid IBAN" );

    $.validator.addMethod( "integer", function( value, element ) {
        return this.optional( element ) || /^-?\d+$/.test( value );
    }, "A positive or negative non-decimal number please" );

    $.validator.addMethod( "ipv4", function( value, element ) {
        return this.optional( element ) || /^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$/i.test( value );
    }, "Please enter a valid IP v4 address." );

    $.validator.addMethod( "ipv6", function( value, element ) {
        return this.optional( element ) || /^((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$/i.test( value );
    }, "Please enter a valid IP v6 address." );

    $.validator.addMethod( "lessThan", function( value, element, param ) {
        var target = $( param );

        if ( this.settings.onfocusout && target.not( ".validate-lessThan-blur" ).length ) {
            target.addClass( "validate-lessThan-blur" ).on( "blur.validate-lessThan", function() {
                $( element ).valid();
            } );
        }

        return value < target.val();
    }, "Please enter a lesser value." );

    $.validator.addMethod( "lessThanEqual", function( value, element, param ) {
        var target = $( param );

        if ( this.settings.onfocusout && target.not( ".validate-lessThanEqual-blur" ).length ) {
            target.addClass( "validate-lessThanEqual-blur" ).on( "blur.validate-lessThanEqual", function() {
                $( element ).valid();
            } );
        }

        return value <= target.val();
    }, "Please enter a lesser value." );

    $.validator.addMethod( "lettersonly", function( value, element ) {
        return this.optional( element ) || /^[a-z]+$/i.test( value );
    }, "Letters only please" );

    $.validator.addMethod( "letterswithbasicpunc", function( value, element ) {
        return this.optional( element ) || /^[a-z\-.,()'"\s]+$/i.test( value );
    }, "Letters or punctuation only please" );

// Limit the number of files in a FileList.
    $.validator.addMethod( "maxfiles", function( value, element, param ) {
        if ( this.optional( element ) ) {
            return true;
        }

        if ( $( element ).attr( "type" ) === "file" ) {
            if ( element.files && element.files.length > param ) {
                return false;
            }
        }

        return true;
    }, $.validator.format( "Please select no more than {0} files." ) );

// Limit the size of each individual file in a FileList.
    $.validator.addMethod( "maxsize", function( value, element, param ) {
        if ( this.optional( element ) ) {
            return true;
        }

        if ( $( element ).attr( "type" ) === "file" ) {
            if ( element.files && element.files.length ) {
                for ( var i = 0; i < element.files.length; i++ ) {
                    if ( element.files[ i ].size > param ) {
                        return false;
                    }
                }
            }
        }

        return true;
    }, $.validator.format( "File size must not exceed {0} bytes each." ) );

// Limit the size of all files in a FileList.
    $.validator.addMethod( "maxsizetotal", function( value, element, param ) {
        if ( this.optional( element ) ) {
            return true;
        }

        if ( $( element ).attr( "type" ) === "file" ) {
            if ( element.files && element.files.length ) {
                var totalSize = 0;

                for ( var i = 0; i < element.files.length; i++ ) {
                    totalSize += element.files[ i ].size;
                    if ( totalSize > param ) {
                        return false;
                    }
                }
            }
        }

        return true;
    }, $.validator.format( "Total size of all files must not exceed {0} bytes." ) );


    $.validator.addMethod( "mobileNL", function( value, element ) {
        return this.optional( element ) || /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)6((\s|\s?\-\s?)?[0-9]){8}$/.test( value );
    }, "Please specify a valid mobile number" );

    $.validator.addMethod( "mobileRU", function( phone_number, element ) {
        var ruPhone_number = phone_number.replace( /\(|\)|\s+|-/g, "" );
        return this.optional( element ) || ruPhone_number.length > 9 && /^((\+7|7|8)+([0-9]){10})$/.test( ruPhone_number );
    }, "Please specify a valid mobile number" );

/* For UK phone functions, do the following server side processing:
 * Compare original input with this RegEx pattern:
 * ^\(?(?:(?:00\)?[\s\-]?\(?|\+)(44)\)?[\s\-]?\(?(?:0\)?[\s\-]?\(?)?|0)([1-9]\d{1,4}\)?[\s\d\-]+)$
 * Extract $1 and set $prefix to