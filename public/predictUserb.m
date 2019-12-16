function [predicted] = predictUserb(userID, movieID, matrix)

    [x,~] = size(matrix);
    
    similarity = zeros(x,2);
    
                  %user to be predicted of

    for i=1:x
    %check only for movies that the user rated
        similarity(i,1) = i;   
        if (userID ~= i)
            user = matrix(userID,:);  
            tempUser = matrix(i,:);
            ratedByBothMovies = ( (tempUser ~= 0) & (user ~= 0));
            
            user1 = user(:,ratedByBothMovies);
            tempUser = tempUser(:,ratedByBothMovies);

            perCoff = corrcoef(user1,tempUser);
            if (size(perCoff) > 1)
                similarity(i,2) = perCoff(2);
            else
                similarity(i,2) = perCoff(1);
            end
            

        else
            similarity(i,2) = NaN;
        end
    end

    K = 10;
   
    notRatedUsers = (matrix(:,movieID) == 0);
    similarity(notRatedUsers,:) = NaN;
    
    a = sortrows(similarity,2,'descend','MissingPlacement','last');      %sort from 1 to NaN

    kNear = a(1:K,:);

    aveOfEachUser = sum(matrix, 2) ./  sum(matrix~= 0,2);
    sumMulSim = 0;                               %nominator
    sumSimil = 0;                                %denominator
    for i = 1:K
        if(~isnan(kNear(i,1)))
        ratingTemp = matrix(kNear(i,1), movieID);
        userIDTemp = kNear(i,1);

        sumMulSim = sumMulSim + (((ratingTemp - aveOfEachUser(userIDTemp)) * kNear(i,2)));
        sumSimil = sumSimil + kNear(i,2);
        end
    end

    predicted = aveOfEachUser(userID) + (sumMulSim / sumSimil);

    if(predicted< 1)
     predicted = 1;
    end
    if(predicted > 5)
     predicted = 5;
    end

end