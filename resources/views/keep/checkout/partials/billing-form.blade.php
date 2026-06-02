

    <!-- Billing Details -->
    <div class="mb-25">
        <h4>Billing Details</h4>
    </div>

    <div class="form-group">
        <input type="text" name="first_name" class="form-control" required placeholder="First name *" value="{{ old('first_name') }}">
    </div>
    <div class="form-group">
        <input type="text" name="last_name" class="form-control" required placeholder="Last name *" value="{{ old('last_name') }}">
    </div>
    <div class="form-group">
        <input type="text" name="address" class="form-control" required placeholder="Address *" value="{{ old('address') }}">
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <input type="text" name="city" class="form-control" required placeholder="City / Town *" value="{{ old('city') }}">
        </div>
        <div class="form-group col-md-4">
            <input type="text" name="state" class="form-control" required placeholder="State / County *" value="{{ old('state') }}">
        </div>
        <div class="form-group col-md-4">
            <input type="text" name="zipcode" class="form-control" required placeholder="Postcode / ZIP *" value="{{ old('zipcode') }}">
        </div>
    </div>

    <div class="form-group">
        <input type="text" name="phone" class="form-control" required placeholder="Phone *" value="{{ old('phone') }}">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" required placeholder="Email address *" value="{{ old('email') }}">
    </div>

    <!-- Create Account -->
    <div class="form-group">
        <div class="custome-checkbox">
            <input class="form-check-input" type="checkbox" name="createaccount" id="createaccount">
            <label class="form-check-label" for="createaccount" data-bs-toggle="collapse" data-bs-target="#collapseAccount">
                <span>Create an account?</span>
            </label>
        </div>
    </div>

    <div id="collapseAccount" class="collapse">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
    </div>

    <!-- Shipping Details -->
    <div class="ship_detail">
        <div class="form-group">
            <div class="custome-checkbox">
                <input class="form-check-input" type="checkbox" name="differentaddress" id="differentaddress">
                <label class="form-check-label" for="differentaddress" data-bs-toggle="collapse" data-bs-target="#collapseAddress">
                    <span>Ship to a different address?</span>
                </label>
            </div>
        </div>

        <div id="collapseAddress" class="collapse">
            <div class="form-group">
                <input type="text" name="shippingfirstname" class="form-control" placeholder="First name *" value="{{ old('shippingfirstname') }}">
            </div>
            <div class="form-group">
                <input type="text" name="shippinglastname" class="form-control" placeholder="Last name *" value="{{ old('shippinglastname') }}">
            </div>
            <div class="form-group">
                <input type="text" name="shippingaddress" class="form-control" placeholder="Address *" value="{{ old('shippingaddress') }}">
            </div>
            <div class="form-group">
                <input type="text" name="shippingphone" class="form-control" placeholder="Phone *" value="{{ old('shippingphone') }}">
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="mb-20">
        <h5>Additional information</h5>
    </div>
    <div class="form-group mb-30">
        <textarea name="order_note" class="form-control" rows="5" placeholder="Order notes">{{ old('order_note') }}</textarea>
    </div>

   

