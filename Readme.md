We’d love for you to take a spin at building a small sample software application so we can see a bit about your skillset, experience, comfort level, etc.… We’d like you to spend some time on this, but don’t want you to spend days on this. In our experience, this should be able to be done entirely in < 8 hours by one of our senior team.
I’m writing this up in stages. Please complete at least stage 1. If you have some time / energy / want to show off your skills, feel free to complete additional stages (again, all the stages should be doable in < 8 hours). Upon completion, please deliver your code to a free GitHub repo as well as a video walk through of the code and a running program (it does not need to be fancy, just a 1 – 3-minute walk through of the code, structure, and show it working).
Objective: Build a PHP application which has a form, can store the form in a SQL Server database and can send the contents of the form to a web API.
Stage 1:

1. Present a UI view which has several components:
2. A form to send a text message. This should have a To (phone number, or a list of phone numbers), and a message
3. A button to send the form, and some validation would be nice.
4. A list of previously sent text messages with column headers. Sortable would be nice.
5. The UI view should connect to a SQL Server database, with two tables:
6. One table for the messages
7. Id primary key
8. Date / Time created
9. To field
10. Message field
11. One table for the sending of the messages
12. Id primary key
13. Foreign Key to the messages Id
14. Date / Time sent
15. Confirmation code from Twilio
16. When the user clicks the button to send the form, it should store in the database table.
    Stage 2:
17. Using the Twilio API, send out a message
18. Likely should store the Twilio credentials somewhere, not in the code … a database table, or a file, or a build property
19. When the user clicks the button to send the form, it should store in the database table AND send a text message to Twilio
20. The response back from Twilio should be stored in the database table
    Stage 3:
21. The response back from Twilio should be stored in the database table AND should be shown in the UI
    Where appropriate, please abstract the storage of the data into the appropriate classes / architecture. Our main code base has well over 1,000,000 lines of code, so we need to make sure there’s clear code abstraction even if it’s a small amount of code.
    Please use the appropriate Entity Framework objects / etc.… and if you’re familiar with TDD or BDD, feel free to include those tests. If you normally use logging, please tie that in as well.
    If you have any questions or need any clarification, please let me know. Again, the goal is to understand how you work and how we might work together.

Create a .env file following the .env.example and fill the fields properly
