FROM node:14-alpine as build-stage
WORKDIR /app
COPY ../../../frontend/package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM nginx:1.23.3-alpine as production
COPY /frontend/dist /usr/share/nginx/html
RUN rm -f /etc/nginx/conf.d/default.conf
COPY ./.docker/docker/frontend/nginx.conf /etc/nginx/conf.d/
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
