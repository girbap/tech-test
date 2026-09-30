<h1>New customer form</h1>

@error('submission')
    <div>{{ $message }}</div>
@enderror

<form method="POST" action="{{ route('customer.store') }}">
    @csrf

    <div>
        <label for="first_name">First name</label>
        <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}">
        @error('first_name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="last_name">Last name</label>
        <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}">
        @error('last_name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}">
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}">
        @error('phone')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="date_of_birth">Date of birth</label>
        <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth') }}">
        @error('date_of_birth')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <input id="marketing_consent" name="marketing_consent" type="checkbox" value="1" @checked(old('marketing_consent'))>
        <label for="marketing_consent">Would you like to receive marketing correspondence?</label>
        @error('marketing_consent')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Submit</button>
</form>
