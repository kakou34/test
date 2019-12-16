function [prediction] = predict(userID, movieID)

load('matrix.mat', 'matrix');

userb = predictUserb(userID, movieID, matrix);
itemb = predictItemb(userID, movieID, matrix);

prediction = [userb; itemb];

csvwrite('C:\xampp\htdocs\test\public\prediction.csv', prediction);

end