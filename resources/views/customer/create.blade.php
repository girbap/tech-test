<h1>New customer form</h1>

<form method="POST" action="{{ route('customer.store') }}">

    <div>
        <label for="first_name">First name</label>
        <input id="first_name" name="first_name" type="text">
    </div>

    <div>
        <label for="last_name">Last name</label>
        <input id="last_name" name="last_name" type="text">
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="tel">
    </div>

    <div>
        <label for="date_of_birth">Date of birth</label>
        <input id="date_of_birth" name="date_of_birth" type="date">
    </div>

    <div>
        <input id="marketing_consent" name="marketing_consent" type="checkbox" value="1">
        <label for="marketing_consent">Would you like to receive marketing correspondence?</label>
    </div>

    <button type="submit">Submit</button>
</form>
