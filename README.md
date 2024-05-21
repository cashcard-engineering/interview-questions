# IRRIGATION SYSTEM
[Link to solution Document](/Document.md)
Your task is to design and implement a RESTful API for managing an irrigation system. The system should allow users to manage irrigation zones, schedules, and watering events. Additionally, whenever a schedule is created or updated, an email should be sent to the admin (admin@cashcardng.com).

## Requirements

### Zones Management
CRUD a zone
   ```
   {
    "name": "string",
    "area": "string"
   }
   ```
### Schedule Management 
```
{
  "start_time": "string",
  "duration": "string",
  "days_of_week": ["string"]
}
```

### Watering Event 
1. Start watering a zone
2. Stop watering a zone
3. Get zone watering status

## Acceptance Criteria
#### Zone Management

- Users can create, retrieve, update, and delete irrigation zones.
- Users can list all irrigation zones.
#### Schedule Management

- Users can create, retrieve, update, and delete schedules for specific zones.
- Users can list all schedules for a specific zone.
- An email is sent to the admin whenever a schedule is created or updated.

#### Watering Events

- Users can start and stop watering for a specific zone.
- Users can retrieve the current status of a specific zone (watering or stopped).

#### Email Notification

- An email is sent to the admin email address provided in the configuration whenever a schedule is created or updated.

## Additional Considerations
- Authentication & Authorization: Ensure only authorized users can manage zones and schedules.
- Validation: Validate the input data for creating and updating zones and schedules.
- Error Handling: Proper error messages for cases like invalid zone ID, schedule conflicts, etc.

NB: Solution should be in Laravel 8+
