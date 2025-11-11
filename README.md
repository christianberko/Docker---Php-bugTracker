# Docker-BugTracker

Hey prof, this project was done in 341, its a bug tracking system made for the ISTE341 Company wants to keep track of bugs in their various projects and who is
responsible for fixing them. Create user function for admin probably doesnt work just a heads up.

to run:
docker pull cberko1/tracker:tagname
docker run -d -p 8000:8000 --name tracker-app cberko1/tracker:tagname

Credentials for the different users:

Admin
- Username: admin_user
- Password: beetle

Manager
- Username: manager_user
- Password: butterfly

User
- Username: user1
- Passwword: spider

