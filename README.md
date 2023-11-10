# ddd-mob

## How to
To set up your environment maker sure that you have docker environment configured. 
If not please install `Docker for Desktop` or any other compatible app.

If Docker is running then execute command from CLI

`make setup`

or if you don't have make command

`docker compose run --rm setup`

or if you are using PHPStorm IDE you can run configuration named `setup` from configurations menu


## Domain Model
The system goal is to support process of delivery software to the target environment.
The domain model consist of:
- Change: unit of code changes delivered together 
- Sha: unique identifier of a Change
- ChangeConfirmation: Information if particular change is Confirmed. Confirm means that the change was tested and is working as intended
- Deployment: Process of releasing one or more Change. This process can contain multiple steps, with various conditions between them
- Delivery: Single step of a Deployment process. Delivery consist of on or more Changes that are deliver to some Stage. 
  It also contains information about a Change Confirmation.
- Log: This is a list of all Changes that are registered and tracked by the system
