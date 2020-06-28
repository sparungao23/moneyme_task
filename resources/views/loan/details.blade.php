@extends('layouts.mainlayout')
@section('content')

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="{{ url('/') }}">
            MoneyMe
        </a>    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
</nav>


    <div class="container customWidth">
      <br /><br />
      <div class="card border-info">
        <div class="card-header text-center">
            <h4 class="mb-3">Your Quote</h4>
        </div>

     <div class="card-body">  
      <div class="row">
        <div class="col-md-12 order-md-1">
          
          <form action="{{url('loan-request/update-repayment')}}" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $response->id ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-3">Your Information</h5>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <a class="small mm-font-color" href="{{url('loan-request/' . $response->id)}}">Edit</a>   
                </div>    
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                   <label>Name</label>
                </div>
                <div class="col-md-9 mb-3 text-right">
                    <?php echo $response->first_name . " " . $response->last_name; ?>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                   <label>Mobile</label>
                </div>
                <div class="col-md-9 mb-3 text-right">
                    <?php echo $response->mobile_number; ?>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                   <label>Email</label>
                </div>
                <div class="col-md-9 mb-3 text-right">
                    <?php echo $response->email; ?>
                </div>    
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-3">Financial Details</h5>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <a class="small mm-font-color" href="{{url('loan-request/' . $response->id)}}">Edit</a>   
                </div>    
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-3">Finance Amount</h5>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <?php echo $response->amount_required; ?> <br />
                    over <?php echo $response->term * 12; ?>  months
                </div>    
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-3">Repayment From</h5>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <?php echo $response->weekly_payment; ?><br />
                    weekly
                </div>    
            </div>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Apply Now</button>
            <p class="text-justify small">
            <small>
            Total repayments <?php echo $response->total_repayment; ?>, made up of an establishment fee of $300.00,
            interest of <?php echo $response->total_interest_rate; ?>. The repayment amount is based on the variables
            selected, is subject to our assessment and suitability, and other important terms  and conditions apply.
            </small>
            </p>
          </form>
        </div>
      </div>
     </div>
      </div>
    </div>
@endsection
