up:
	symfony server:stop
	docker compose up -d
	symfony server:start -d --no-tls
	symfony run -d npx encore dev-server
	symfony server:log

down:
	docker compose down
	symfony server:stop