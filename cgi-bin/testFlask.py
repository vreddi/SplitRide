from flask import Flask, render_template

# Creating the instance of the Web-App
app = Flask(__name__)

@app.route("/")
def hello():
	return 'Hello World!'


# Returns an HTML Web Page
@app.route("/user/<username>")
def user(username):
	return render_template('profile.html', name = username)


if __name__ == "__main__":
	app.run()