FROM nginx:1.17

RUN mkdir -p /var/www/mobc/public

#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
RUN echo 'PS1="\[\033[36m\]\u\[\033[m\]@\[\033[95;1m\]mobc.nginx:\[\033[34m\]\w\[\033[m\]\$ "' >> ~/.bashrc
# home dir for www-data
RUN echo 'PS1="\[\033[36m\]\u\[\033[m\]@\[\033[95;1m\]mobc.nginx:\[\033[34m\]\w\[\033[m\]\$ "' >> /var/www/.bashrc
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

RUN apt-get update && apt-get install -y \
    vim \
    wget
RUN apt-get clean \
    && rm -rf /tmp/* /var/tmp/* /var/lib/apt/lists/*

RUN rm -f /etc/nginx/nginx.conf /etc/nginx/sites-enabled/* /etc/nginx/conf.d/*
COPY nginx.conf /etc/nginx/
COPY app.conf /etc/nginx/sites-enabled/
COPY general.conf /etc/nginx/conf.d/

WORKDIR /var/www/mobc/public

ADD entrypoint.sh /usr/local/bin/

CMD ["entrypoint.sh"]
