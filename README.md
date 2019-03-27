

##Docker with codeigniter-apache-ssl 
This image serves as a starting point for legacy CodeIgniter projects.
> https://github.com/manzurshaikh/codeigniter-apache-ssl.git

- docker-compose up --build -d 
- docker-compose ps
> access the webpage using IP / Domain 

- SSL certificate copy into ssl directory
- replace certificate and update into docker-compose.yml
  
  ## Working with Local Files
- Using Docker volumes, you can mount local files inside a container.
