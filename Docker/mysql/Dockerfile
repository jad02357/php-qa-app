FROM mysql:5.7

ADD ./Docker/mysql/conf.d/my.cnf /etc/mysql/conf.d/my.cnf
COPY ./Docker/mysql/sqls/* /docker-entrypoiny-initdb.d/

CMD ["mysqld"]

