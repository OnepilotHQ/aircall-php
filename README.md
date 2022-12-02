This is a non-official Aircall PHP library which provides access to the Aircall API from applications written in the PHP language.

Api references: https://developer.aircall.io/api-references/

## Usage
### Clients

```php
use Aircall\AircallClient;

$client = new AircallClient(appId, apiKey);

// Test purpose
$client->ping();
```


### Base

You can access this five methods from all endpoints that are not defined by custom class
```php
$client->{endpoint}->list();
$client->{endpoint}->for($id)->get();
$client->{endpoint}->create($options);
$client->{endpoint}->for($id)->update($options);
$client->{endpoint}->for($id)->delete();

```

### Users

```php
// Get a user by ID
$client->users->for($id)->get();

// List all users
$client->users->list();
```

### Calls

```php
// Get a call by ID
$client->calls->for($id)->get();

// List all calls
$client->calls->list();

// Search calls
$client->calls->search([
  'tags' => 'myTag',
]);

// Display a link in-app to the User who answered a specific Call.
$client->calls->for($id)->link([
    'link' => 'http://something.io/mypage'
]);

// Transfer the Call to another user.
$client->calls->for($id)->transfert([
    'user_id' => 8945487
]);

// Delete the recording of a specific Call.
$client->calls->for($id)->deleteRecording();

// Delete the voicemail of a specific Call.
$client->calls->for($id)->deleteVoicemail();
```

### Contacts

```php
// List all contacts
$client->contacts->list();

// Get a contact by ID
$client->contacts->for($id)->get();

// Create a contact
$client->contacts->create([
    'first_name'    => 'John',
    'last_name'     => 'Doe',
    'information'   => 'TEST',
    'phone_numbers' => [
        [
            'label' => 'Work',
            'value' => '+33631000000',
        ],
    ],
    'emails' => [
        [
            'label' => 'Work',
            'value' => 'john.doe@something.io',
        ],
    ],
]);

// Search contacts
$client->contacts->search([
    'phone_number' => '+33631000000',
    'email' => 'john.doe@something.io'
]);

// Update data for a specific Contact
$client->contacts->for($id)->update([
  'first_name'    => 'John',
  'last_name'     => 'Doe',
  'information'   => 'TEST',
  'phone_numbers' => [
      [
          'label' => 'Work',
          'value' => '+33631000000',
      ],
  ],
  'emails' => [
      [
          'label' => 'Work',
          'value' => 'john.doe@something.io',
      ],
  ],
]);

// Delete a specific Contact
$client->contacts->for($id)->delete();
