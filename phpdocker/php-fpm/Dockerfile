FROM phpdockerio/php74-fpm:latest

WORKDIR "/application"

RUN apt-get update; \
    apt install sqlite3; \
    apt-get -y --no-install-recommends install \
        git \ 
        php7.4-bcmath \ 
        php7.4-bz2 \ 
        php7.4-mysql \ 
        php7.4-odbc \ 
        php7.4-phpdbg \ 
        php7.4-redis \ 
        php7.4-soap \ 
        php7.4-sqlite3 \ 
        php7.4-ssh2 \ 
        php7.4-xsl \
        php7.4-mbstring \
        php7.4-xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


# Atualizar permissões de log em arquivo
# RUN chmod -R ugo+rwx application/storage/
