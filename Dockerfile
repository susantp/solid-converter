FROM php:8.1.8-fpm-bullseye

USER root

RUN apt-get update && apt-get install -y \
            build-essential \
            libssl-dev \
            zlib1g-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupadd -g ${PGID} apache && \
    useradd -l -u ${PUID} -g apache -m apache && \
    usermod -p "*" apache -s /bin/bash

###########################################################################
# Set Timezone
###########################################################################

ARG TZ=UTC+05:45
ENV TZ ${TZ}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

USER apache

# COPY --chown=apache:apache . /var/www
WORKDIR /var/www