# Notes

## Running the application

The process to run the application is no different to the process outlined in README.md. The following entries will need to be added to your .env file:

WEBHOOK_URL="https://webhook.site/f22df2d6-dc9f-412c-9857-54e868108fe7"
WEBHOOK_TOKEN="<find in readme file>"

## Decisions and assumptions

### Validation

Validation of the form input is handled under the following rules:

- First name and last name are required strings
- Email is required and must have the "pattern" of a valid email.
- Phone is required string containing between 7 and 16 digits with an optional leading +.
- Date of birth is a required date before today.
- Marketing consent is an optional boolean.

Length limits weren't applied to first name, last name, or email as I couldn't determine a defensible limit. In reality, a limit would probably be determined by the API client or the column type of the database table.

When validation fails (either through invalid input or API call failure) the user is redirected back to the form with their old values retained for editing/resubmission. Validation messages are displayed by their respective fields in the form.

### API integration

The webhook URL and token are stored in the .env file to keep them out of the application code. The variables are retrieved through config/services.php.

The API call is handled through WebhookApiService with a 5 second timeout.

Any successful 2xx response is treated as a successful submission.

If the API returns an unsuccessful response or a ConnectionException then the user is returned to the form with an error message.

### Results page

After a successful request the user is shown a results page with the details that they have just submitted. This view is returned directly from the POST endpoint so it's not possible to see the page without having submitted the form. However, it does leave open the possibility of the submission being repeated if the user refreshes the page. Solving this was considered out of scope for the task.

### Front end

The design of the front-end is intentionally minimalist with no advanced styling or client-side validation.

## Tests

11 feature tests covering expected system behaviour. API calls are simulated using Http::fake(...) and all other  external HTTP requests are prevented using Http::preventStrayRequests().

Tests can be run using:

```php artisan test```

or:

```php vendor/bin/phpunit```

## Next steps

Given more time I would have liked to:

- Add client-side validation to the form for quicker feedback
- Improve the front-end styling
- Handle refreshing of the results page
- Add logging or reporting of API call exceptions