import flask
from flask import jsonify
from flask_cors import CORS
from recomendation import Recomendation


app = flask.Flask(__name__)
CORS(app)
app.config["DEBUG"] = True

@app.route('/',methods=['GET'])
def home():
    return "Server is up and running!!"

@app.route('/getRecomendation',methods=['GET'])
def getRecomendation():
    recom = Recomendation()
    response = recom.getRecomendation()
    return jsonify(response)

app.run()