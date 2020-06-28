@extends('layouts.mainlayout')
@section('content')

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

            <div class="row ">
                <div class="col-md-6 mb-1">
                    <h6 class="mb-3 mm-font-gray">Finance Amount</h6>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <h7 class="mm-font-color"><?php echo money_format('$%i', $response->amount_required); ?> 
                    </h7>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                        <div class="separator"><small>over <?php echo $response->term * 12; ?>  months</small></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-1">
                    <h6 class="mb-3 mm-font-gray">Repayment From</h6>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <h7 class="mm-font-color">
                    <?php echo money_format('$%i', $response->weekly_payment); ?> 
                    </h7>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                        <div class="separator"><small>weekly</small></div>
                </div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Apply Now</button>
            <p class="text-justify small">
            <small>
            Total repayments <?php echo money_format('$%i', $response->total_repayment); ?>, made up of an establishment fee of $300.00,
            interest of <?php echo money_format('$%i', $response->total_interest); ?>. The repayment amount is based on the variables
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
