FROM apache/activemq-classic:5.18.3

RUN sed -i 's/Context createConnector="false"/Context createConnector="true"/g' /opt/apache-activemq/conf/activemq.xml
RUN sed -i 's/property name="host" value="127.0.0.1"/property name="host" value="0.0.0.0"/g' /opt/apache-activemq/conf/jetty.xml
RUN sed -i 's/<strict-checking\/>/<allow-origin>*<\/allow-origin>/g' /opt/apache-activemq/conf/jolokia-access.xml
