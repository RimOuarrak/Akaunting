## Installation


* Clone the repository: `git clone https://github.com/RimOuarrak/akaunting.git`
* modify the name of the ".env.example" file to ".env"
* Install dependencies: `docker-compose up --build  `
* Install Akaunting:

You can open the terminal of the container directly from Docker, but it's a bit slow. Alternatively, you can run the command "docker ps" on your terminal to retrieve the container ID (usually the first ID listed), and then use the command "docker exec -it copied ID bash" to open a terminal session within the container. Now you can execute the command.

```bash
php artisan install --db-host="db" --db-name="akaunting" --db-username="root" --db-password="pass" --admin-email="admin@company.com" --admin-password="123456"
```

now you can log in using the mail and password above
