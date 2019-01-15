package friedChicken;

import java.io.IOException;

public class Main {
	static ConnectDB db;
	public static void main(String[] args) throws IOException {
		// TODO Auto-generated method stub
		// 5356,5484
		try {
			db = new ConnectDB("teamfried","root","realstart");
			new DataExtract();
			db.exitDB();
			System.out.println("종료");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
