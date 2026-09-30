<h1>Your submission has been successful</h1>

<div>
    <strong>First name:</strong>
    <span>{{ $first_name }}</span>
</div>

<div>
    <strong>Last name:</strong>
    <span>{{ $last_name }}</span>
</div>

<div>
    <strong>Email:</strong>
    <span>{{ $email }}</span>
</div>

<div>
    <strong>Phone:</strong>
    <span>{{ $phone }}</span>
</div>

<div>
    <strong>Date of birth:</strong>
    <span>{{ $date_of_birth }}</span>
</div>

<div>
    <strong>Receive marketing information:</strong>
    <span>{{ ($marketing_consent ?? false) ? 'Yes' : 'No' }}</span>
</div>
