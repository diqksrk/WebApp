package friedChicken;

import java.util.ArrayList;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;


public class DataExtract {
	DataExtract() throws Exception {
		ArrayList<Integer> error = new ArrayList<Integer>();
		//Start 5328, End 6400
		for (int i = 5200; i <= 6600; i++) {
			Document doc = Jsoup.connect("http://www.mcst.go.kr/web/s_culture/festival/festivalView.jsp?pSeq=" + i)
					.get();

			Elements items = doc.select(".tit01"), temp;// ������
			if (items.size() == 0 || !(items.get(0).text().contains("2017")|| items.get(0).text().contains("2018")))
				continue;
			
			try {
				String festival = new String(items.get(0).text().getBytes("UTF-8"));
				System.out.println(festival);
				items = doc.select(".cont");// ���� ����
				
				temp = items.select("td");
				items = items.select("th");

				if (items.size() != temp.size()) {
					error.add(i);
					continue;
				}

				int index = 0;
				StringBuffer contents = new StringBuffer("");
				StringBuffer favorite = new StringBuffer("");
				String date = null;
				for (Element title : items) {
					if(title.text().equals("개최지역"))
						favorite.append(String.format("%02d", localNum(temp.get(index).text())));
					else if(title.text().equals("축제성격"))
						favorite.append(String.format("%02d", typeNum(temp.get(index).text())));
					else if(title.text().equals("개최기간"))
						date = temp.get(index).text();
					contents.append(title.text() + " : " + temp.get(index).text() + "\n");
					index++;
				}

				items = doc.select(".story");// comment
				contents.append(new String(items.get(1).text().getBytes("UTF-8")));
				
				items = doc.select(".pic");
				if(Main.db.sendQuery("INSERT INTO board VALUES("+i+", '"+festival+"','"+date+"','"+"http://www.mcst.go.kr"+items.select("img").attr("src")+"')") <= 0)
					error.add(i);
				if(Main.db.sendQuery("INSERT INTO board_detail VALUES("+i+", '"+favorite.toString()+"','"+contents.toString()+"')") <= 0){
					error.add(i);
				}
				
			} catch (IndexOutOfBoundsException e) {
				error.add(i);
			}
		}
			
		System.out.println("===================================");
		for (int item : error)
			System.out.println(item);
		
	}
	private int localNum(String local){
		String[] localArray = {"서울시", "경기도","부산시","대구시","인천시","광주시","대전시","울산시","세종시","강원도","충청북도","충청남도","전라북도","전라남도","경상북도","경상남도","제주도"};

		for(int i = 0; i < 17; i++)
			if(local.contains(localArray[i]))
				return i+1;
		
		return 18;
	}
	private int typeNum(String type){
		switch(type){
		case "문화예술":
			return 1;
		case "전통역사":
			return 2;
		case "경연사업":
			return 3;
		case "생태자원":
			return 4;
		case "지역특산물":
			return 5;
		case "기타":
			return 6;
			default:
				return 7;
		}
	}
}
