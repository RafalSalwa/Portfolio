up:
	#symfony server:stop
	symfony server:start -d --no-tls
	symfony run -d yarn encore dev-server --port 9000
	symfony server:log

down:
	docker compose down
	symfony server:stop
