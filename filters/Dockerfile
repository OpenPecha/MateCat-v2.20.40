FROM alpine:3.18 AS buildenv

RUN apk update && \
    apk add git openjdk8 maven

WORKDIR /src

# okapi commit that will be checked out
ENV OKAPI_COMMIT="c475ad8598d58202acad5a3cf508836aa0dc8d2a"
# MateCat Filters .jar version that will be built from FILTERS_COMMIT
ENV FILTERS_VERSION=1.2.5

# Now we build ...
RUN git clone https://bitbucket.org/okapiframework/okapi.git okapi && \
    cd okapi/ && \
    git checkout ${OKAPI_COMMIT} && \
    mvn clean install -DskipTests

RUN git clone --branch v${FILTERS_VERSION} --depth 1 https://github.com/matecat/MateCat-Filters.git MateCat-Filters && \
    cd MateCat-Filters/filters && \
    mvn clean package -DskipTests

##########################

FROM alpine:3.18

ENV FILTERS_VERSION=1.2.5

RUN apk add bash openjdk8

# Copy files to destination folder for filter service
WORKDIR /app/filters
COPY --from=buildenv /src/MateCat-Filters/filters/target/filters-${FILTERS_VERSION}.jar ./
COPY --from=buildenv /src/MateCat-Filters/filters/src/main/resources/config.sample.properties ./config.properties
COPY --chmod=0755 ./entrypoint.sh ./

ENTRYPOINT [ "/app/filters/entrypoint.sh" ]
