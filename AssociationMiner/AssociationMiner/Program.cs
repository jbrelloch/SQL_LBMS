using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AssociationMiner
{
    class Program
    {
        private static int requiredFrequency = 500;

        private static Dictionary<int[], Double> aprioriResults = new Dictionary<int[], Double>();
        private static List<int[]> dataSetLines;

        private static MySqlConnection conn;

        static void Main(string[] args)
        {
            if(args.Length != 1)
            {
                Console.WriteLine("AssociationMiner [Frequency]");
                while (true) ;
            }

            List<string> fileLines = new List<string>();	
            //READ LINES - IN MY CASE READ IN DATABASE ENTRIES

            string connStr = "server=localhost;user=root;database=lbms;port=3306;password=tiger0915;";
            conn = new MySqlConnection(connStr);
            try
            {
                Console.WriteLine("Connecting to MySQL...");
                conn.Open();
                // Perform database operations
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.ToString());
            }
            conn.Close();
            Console.WriteLine("Done.");

            //////////////////////////////////////////////////
		
            //int maxValue = getMaxValue(fileLines);
            dataSetLines = convertEntriesToIntArrays(fileLines);
		
            bool continueRun = true;
            int count = 1;
            while(continueRun)
            {
                getFrequencyNumbers(count);
			
                trimMap(count);
			
                continueRun = getStatus(count);
                count++;
            }
		
            //int count = 0;
            //for(int numFreq : numberFrequencies)
            //{
            //    System.out.println(count + " FREQ: " + numFreq);
            //    count++;
            //}
        }

        //public static int getMaxValue(List<String> fileLines)
        //{
        //    int maxValue = 0;
        //    for(String line : fileLines)
        //    {
        //        String[] splitFileLine = line.split(" ");
        //        for(String lineSec : splitFileLine)
        //        {
        //            String trimLineSec = lineSec.trim();
        //            int tempValue = -1;
        //            try
        //            {
        //                tempValue = Integer.parseInt(trimLineSec);
        //            }
        //            catch (NumberFormatException e)
        //            {
        //                e.printStackTrace();
        //            }
        //            if(tempValue > maxValue)
        //                maxValue = tempValue;
        //        }
        //    }
        //    return maxValue;
        //}

        public static void trimMap(int count)
	    {
            //LinkedList<int[]> removeList = new LinkedList<int[]>();
            ////first convert all base counts to percentages
            //for(Map.Entry<int[], Double> entry : aprioriResults.entrySet())
            //{
            //    if(entry.getKey().length == count)
            //    {
            //        double holder = entry.getValue() / 100000;
            //        entry.setValue(holder);
            //        if(holder < requiredFrequency)
            //        {
            //            removeList.add(entry.getKey());
            //        }
            //    }
            //}
		
            ////next cut out all mapEntries that do not meet the minimum base frequency
            //for(int[] removeItemKey : removeList)
            //{
            //    aprioriResults.remove(removeItemKey);
            //}
	    }

        public static void getFrequencyNumbers(int count)
	    {
            foreach(int[] line in dataSetLines)
            {
                List<int[]> combinations = getCombinations(line, count);
                foreach(int[] combo in combinations)
                {
                    if(aprioriResults.ContainsKey(combo))
                    {
                        double holder = aprioriResults[combo] + 1;
                        aprioriResults[combo] = holder;
                    }
                    else
                    {
                        aprioriResults[combo] = 1.0;
                    }
                }
            }
	    }

        public static List<int[]> getCombinations(int[] line, int count)
	    {
            //GETS ALL COMBINATIONS FOR CURRENT ENTRY

		    List<int[]> pSet = new List<int[]>();
		
		    int elements = line.Length;
		
		    int powerElements = (int) Math.Pow(2, elements);
		
		    for (int i = 0; i < powerElements; i++)
		    {
			    String binaryCount = Convert.ToString(i,2);
			
			    List<int> tempSet = new List<int>();
			
			    for (int j = 0; j < elements; j++)
			    {
				    if(binaryCount[j]=='1')
				    {
					    tempSet.Add(line[j]);
				    }
			    }
			
			    pSet.Add(tempSet.ToArray());
		    }
		
		    //trim the full powerset
		    foreach(int[] sublist in pSet)
		    {
			    if(sublist.Length == count)
			    {
				    int[] tempArray = new int[count];
				
				
			    }
		    }

            return pSet;
	    }

        public static bool getStatus(int count)
	    {
            // THIS FUNCTION CHECKS TO SEE IF ANY FREQUENT SETS WHERE FOUND IN LAST RUN

            //Set<int[]> mapKeySet = aprioriResults.keySet();
		
            //for(int[] key : mapKeySet)
            //{
			
            //}
		
		    return false;
	    }

        public static List<int[]> convertEntriesToIntArrays(List<string> fileLines)
	    {
            //SEPERATE EACH ENTRY INTO AN ARRAY OF ITEM IDS
		    List<int[]> results = new List<int[]>();
		    foreach(string line in fileLines)
		    {
			    string[] splitFileLine = line.Split(' ');
			    int[] arrayHolder = new int[splitFileLine.Length];
                for (int i = 0; i < splitFileLine.Length; i++)
			    {
				    String trimLineSec = splitFileLine[i].Trim();
				    int value = -1;
				    
                    value = int.Parse(trimLineSec);

				    arrayHolder[i] = value;
			    }
			    results.Add(arrayHolder);
		    }
		    return results;
	    }
    }
}
