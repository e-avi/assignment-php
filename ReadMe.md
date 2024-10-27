# ReadMe

## Important Instruction
**Highest Priority:** Ensure that the `users.sql` table is added to the database called `assignment` before testing the application.

## Result

1. **Sign-Up and Login Pages**
    - **Sign-Up Page:**
      - Form fields: Username, Email, Password, Confirm Password.
      - Validation: Validate input fields on the client side for format and required fields.
      - Upon successful sign-up, store user information in the database and display a confirmation message.
    - **Login Page:**
      - Form fields: Username/Email and Password.
      - Validate the credentials against the database.
      - On successful login, redirect to a dashboard or home page.

2. **Dashboard/Home Page**
    - Display a table with columns: Username, Email, and Sign-Up Date.
    - Only registered users should have access to this page.
    - Include CRUD operations on the user data within the table.

3. **CRUD Operations (AJAX-Based)**
    - **Create:** Allow new users to sign up, storing their data in the database.
    - **Read:** Fetch and display user data in the table on the dashboard/home page.
    - **Update:** Enable editing of user details directly in the table with real-time updates.
    - **Delete:** Provide an option to delete user records from the table and database.

4. **Technology Stack**
    - **Frontend:** HTML, CSS, JavaScript (AJAX)
    - **Backend:** PHP
    - **Database:** MySQL
    - **Additional Libraries/Frameworks:** jQuery, Bootstrap