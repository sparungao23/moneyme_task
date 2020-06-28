@extends('layouts.mainlayout')
@section('content')
    <div class="container">
      <br /><br />
      <div class="card border-info">
        <div class="card-header text-center">
            <h4 class="mb-3">Quote Calculator</h4>
        </div>

        <div class="card-body">  
      <div class="row">
        <div class="col-md-12 order-md-1">
          
          <form action="{{url('loan-request/update')}}" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $response->id ?>">
            <div class="mb-3">
                <input type="text" id="amount-required" name="amount_required" value="<?php echo $response->amount_required ?>" />
                <p class="text-center">How much do you need?</p>
            </div>

            <div class="mb-3">
                <input type="text" id="term" name="term" value="<?php echo $response->term ?>" />
                <p class="text-center">Term</p>
            </div>

            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="title" class="mm-font-color">Title</label>
                    <select name="title" id="Title" class="form-control">
                        <option value="Mr."
                        <?php echo $response->title == 'Mr.' ? 'selected' : ''; ?>    
                            >Mr.</option>
                        <option value="Ms."
                        <?php echo $response->title == 'Ms.' ? 'selected' : ''; ?>    
                        >Ms.</option>
                        <option value="Mrs."
                        <?php echo $response->title == 'Mrs.' ? 'selected' : ''; ?>    
                        >Mrs.</option>
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="firstName">&nbsp;</label>  
                  <input type="text" class="form-control" name="first_name" id="firstName" placeholder="First Name" value="<?php echo $response->first_name; ?>" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="lastName">&nbsp;</label>
                  <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Last Name" value="<?php echo $response->last_name; ?>" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="<?php echo $response->email; ?>" required>
                    <div class="invalid-feedback">
                    Please enter a valid email address
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="mobile_number" id="mobile-number" placeholder="Mobile" value="<?php echo $response->mobile_number; ?>" required>
                    <div class="invalid-feedback">
                    Mobile number is required
                    </div>    
                </div>    
            </div>

            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Calculate Quote</button>
            <p class="text-center small"><small>Quote does not affect your credit score</small></p>
          </form>
        </div>
      </div>
     </div>
      </div>
    </div>
@endsection
