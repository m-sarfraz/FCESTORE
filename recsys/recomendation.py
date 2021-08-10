# Important Libraries
import pandas as pd
import numpy as np
import sklearn
from sklearn.decomposition import TruncatedSVD
import warnings

class Recomendation:
    
    def getRecomendation(self):#C:\xampp\htdocs\mobiway\recsys
        products = pd.read_csv(r'Z:\\htdocs\mobiway\recsys\ProductDetail.csv', sep=',')
        products = products.iloc[:, :10]
        products = products.drop(columns=['Category-id', 'Product-code','Product-color','description','care','status','price','weight'])
        products.head(10)
        products.shape
        ratings = pd.read_csv(r'Z:\\htdocs\mobiway\recsys\ProductCart.csv', sep=',')
        ratings = ratings.iloc[:, :11]
        ratings = ratings.drop(columns=['product_name', 'product_code','product_color','color','quantity','user_email','price'])
        ratings.head(10)
        ratings.shape
        df = pd.merge(products, ratings, on ='product_id')
        df1= df.drop_duplicates(['product_id','Product-name'])
        df1= df.drop_duplicates(['Product-name','session_id'])
        df1.head(10)
        df1.shape

        #MATRIX FACTORIZATION

        products_matrix = df.pivot_table(index = 'session_id', columns = 'product_id', values= 'rating').fillna(0)
        products_matrix.head()
        products_matrix.shape

        X = products_matrix.values.T
        X.shape

        #Fitting the Model

        SVD = TruncatedSVD(n_components=12, random_state=100)
        matrix = SVD.fit_transform(X)
        matrix.shape
        import warnings
        warnings.filterwarnings("ignore",category =RuntimeWarning)

        # Correlation coeficient

        corr = np.corrcoef(matrix)
        corr.shape
        title = products_matrix.columns
        title_list = list(title)
        new_user = title_list.index(21)
        corr_new_user  = corr[new_user]

        return list(title[(corr_new_user >=0.4)])