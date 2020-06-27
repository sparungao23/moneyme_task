<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

<title>MoneyMe</title>

<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">
<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<!--Plugin CSS file with desired skin-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
 
<!-- Custom styles for this template -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<style>
.container {
  width:700px;
}

@media only screen and
(max-width : 1249px ) {
    .container {
        width:100%;
    }
}

.irs--flat .irs-handle>i:first-child {
    background-color: #64D5D4!important;//Replace With Your color code
}
.irs--flat .irs-bar {
    background-color: #64D5D4!important;//Replace With Your color code
}
.irs--flat .irs-from, .irs--flat .irs-to, .irs--flat .irs-single {
    background-color: #64D5D4!important;//Replace With Your color code
}
.irs--flat .irs-from:before, .irs--flat .irs-to:before, .irs--flat .irs-single:before {
    border-top-color: #64D5D4!important;//Replace With Your color code
}

.irs-bar, .irs-line,.irs-slider{
        transform: scaleY(1.5);
}

.mm-font-color {
  color: #64D5D4;
}
</style>